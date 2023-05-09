<?php

namespace Core;

class Mpesa
{
    public static function authorize()
    {
        $config = require base_path('config.php');

        $url = $config['daraja']['env'] === '0'
            ? 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials'
            : 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

        $curl = curl_init($url);
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_HTTPHEADER => ['Content-Type: application/json; charset=utf-8'],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER => false,
                CURLOPT_USERPWD => $config['daraja']['MPESA_CONSUMER_KEY'] . ':' . $config['daraja']['MPESA_CONSUMER_SECRET'],
            )
        );

        $response = json_decode(curl_exec($curl));
        curl_close($curl);
        return $response->access_token;
    }

    public static function makeHTTP($url, $body)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . static::authorize(),
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = json_decode(curl_exec($ch));
        curl_close($ch);
        return $response->ResponseCode;
    }

    public function registerURLS()
    {
        $config = require base_path('config.php');

        $body = array(
            'ShortCode' => $config['daraja']['MPESA_SHORTCODE'],
            'ResponseType' => 'Completed',
            'ConfirmationURL' => $config['daraja']['MPESA_TEST_URL'] . '/api/confirmation',
            'ValidationURL' => $config['daraja']['MPESA_TEST_URL'] . '/api/validation',
        );

        $url = $config['daraja']['env'] === '0'
            ? 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl'
            : 'https://api.safaricom.co.ke/mpesa/c2b/v1/registerurl';

        return $this->makeHTTP($url, $body);
    }

    public static function queryTransaction($checkoutrequestid)
    {
        $config = require base_path('config.php');

        $url = $config['daraja']['env'] === '0'
            ? 'https://sandbox.safaricom.co.ke/mpesa/stkpushquery/v1/query'
            : 'https://api.safaricom.co.ke/mpesa/stkpushquery/v1/query';

        $timestamp = date('YmdHis');
        $password = \base64_encode($config['daraja']['MPESA_SHORTCODE'] . $config['daraja']['MPESA_PASSKEY'] . $timestamp);

        $body = array(
            "BusinessShortCode" => $config['daraja']['MPESA_SHORTCODE'],
            "Password" => $password,
            "Timestamp" => date('YmdHis'),
            "CheckoutRequestID" => $checkoutrequestid,
        );

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . static::authorize(),
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = json_decode(curl_exec($ch));
        curl_close($ch);

        return $response->ResultCode ?? 'NULL';
        // return $response;
    }

    public static function B2CAuthorize()
    {
        $config = require base_path('config.php');

        $url = $config['daraja']['env'] === '0'
            ? 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials'
            : 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json;']);
        curl_setopt($ch, CURLOPT_USERPWD, $config['daraja']['MPESA_CONSUMER_KEY_WITHDRAW'] .
            ':' . $config['daraja']['MPESA_CONSUMER_SECRET_WITHDRAW']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = json_decode(curl_exec($ch));
        curl_close($ch);
        return $response->access_token ?? 'NULL';
    }

    public static function withdraw($phone, $amount, $remarks)
    {
        $config = require base_path('config.php');

        $url = $config['daraja']['env'] === '0'
            ? 'https://sandbox.safaricom.co.ke/mpesa/b2c/v1/paymentrequest'
            : 'https://api.safaricom.co.ke/mpesa/b2c/v1/paymentrequest';

        $cert = file_get_contents('ProductionCertificate.cer');

        $pk = openssl_get_publickey($cert);

        openssl_public_encrypt(
            $config['daraja']['MPESA_B2C_PASSWORD'],
            $encrypted,
            $pk,
            $padding = OPENSSL_PKCS1_PADDING
        );

        $encodedPassword = base64_encode($encrypted);

        $body = [
            'InitiatorName' => $config['daraja']['MPESA_B2C_INITIATOR'],
            'SecurityCredential' => $encodedPassword,
            'CommandID' => 'SalaryPayment',
            'Amount' => $amount,
            'PartyA' => $config['daraja']['MPESA_B2C_SHORTCODE'],
            'PartyB' => $phone,
            'Remarks' => $remarks,
            'QueueTimeOutURL' => $config['daraja']['MPESA_TEST_URL'] . '/api/b2ccallBack',
            'ResultURL' => $config['daraja']['MPESA_TEST_URL'] . '/api/b2ccallBack',
            'Occasion' => $remarks
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . static::B2CAuthorize(),
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = json_decode(curl_exec($ch));
        curl_close($ch);

        return $response;
    }
}
