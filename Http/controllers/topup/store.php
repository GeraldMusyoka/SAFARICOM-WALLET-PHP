<?php

use Core\App;
use Core\Mpesa;
use Core\Session;
use Core\Database;
use Http\Forms\TopupForm;

//get form data
$phone = $_POST['phone'];
$amount = $_POST['amount'];

//validate form
$topupForm = new TopupForm();

if (!$topupForm->validate($phone, $amount)) {
    Session::flash('errors', $topupForm->errors());

    redirect('/topup');
} else {
    $config = require base_path('config.php');
    $timestamp = date('YmdHis');
    $password = \base64_encode($config['daraja']['MPESA_SHORTCODE'] . $config['daraja']['MPESA_PASSKEY'] . $timestamp);

    $body = array(
        "BusinessShortCode" => $config['daraja']['MPESA_SHORTCODE'],
        "Password" => $password,
        "Timestamp" => date('YmdHis'),
        "TransactionType" => "CustomerPayBillOnline",
        "Amount" => $amount,
        "PartyA" => $phone,
        "PartyB" => $config['daraja']['MPESA_SHORTCODE'],
        "PhoneNumber" => $phone,
        "CallBackURL" => $config['daraja']['MPESA_TEST_URL'] . '/api/stkpush',
        "AccountReference" => $config['daraja']['MPESA_ACCOUNT'],
        "TransactionDesc" => $config['daraja']['MPESA_ACCOUNT'],
    );
    $url = $config['daraja']['env'] == '0'
        ? 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest'
        : 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . Mpesa::authorize(),
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = json_decode(curl_exec($ch));
    curl_close($ch);

    $responsecode = $response->ResponseCode ?? 'NULL';

    if (!(is_string($responsecode)) || $responsecode != '0') {
        Session::flash('errors', 'Error, please try again.');
        redirect('/topup');
    } else {
        $db = App::resolve(Database::class);

        $db->query('INSERT INTO topups (amount, user_id, checkout_request_id, phone_number, created_at, updated_at) VALUES(:amount, :user_id, :checkout_request_id, :phone_number, :created_at, :updated_at)', [
            'amount' => $amount,
            'user_id' => $_SESSION['user']['id'],
            'checkout_request_id' => $response->CheckoutRequestID,
            'phone_number' => $phone,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        sleep(10);
        
        $checkoutrequestid = $response->CheckoutRequestID;
        if (!is_string(Mpesa::queryTransaction($checkoutrequestid)) || Mpesa::queryTransaction($checkoutrequestid) !== '0') {
            Session::flash('error', 'Error, please try again later.');
            redirect('/topup');
        }

        $topup = $db->query('SELECT * FROM topups WHERE checkout_request_id = :checkout_request_id', [
            'checkout_request_id' => $checkoutrequestid
        ])->findOrFail();

        //update topup status
        $db->query('UPDATE topups SET status = :status WHERE id = :id', [
            'status' => 0,
            'id' => $topup['id']
        ]);
        
        //get user data
        $userdata = $db->query('SELECT * FROM users WHERE id = :id', [
            'id' => $_SESSION['user']['id']    
        ])->findOrFail();
        
        $newwalletbalance = $userdata['wallet_balance'] + $amount;
        
        //update wallet
        $db->query('UPDATE users SET wallet_balance = :wallet_balance WHERE id = :id', [
            'wallet_balance' => $newwalletbalance,
            'id' => $userdata['id']
        ]);

        Session::flash('success', 'Topup successful.');

        redirect('/topup');
    }
}
