<?php

use Core\App;
use Core\Session;
use Core\Database;
use Core\Mpesa;
use Http\Forms\WithdrawForm;

$amount = $_POST['amount'];
$phone = $_POST['phone'];

//validate
$withdrawForm = new WithdrawForm();

if (!$withdrawForm->validate($phone, $amount)) {
    Session::flash('errors', $withdrawForm->errors());

    redirect('/withdraw');
}

$db = App::resolve(Database::class);

$user = $db->query('SELECT * FROM users WHERE id = :id', [
    'id' => $_SESSION['user']['id']
])->findOrFail();

$tariff = $db->query('SELECT * FROM tariffs WHERE min <= :amount AND max >= :amount', [
    'amount' => $amount
])->findOrFail();

if ($amount + $tariff['tariff'] > $user['wallet_balance']) {
    Session::flash('error', 'Insufficient funds in your wallet.');
    redirect('/withdraw');
} elseif ($amount < 10) {
    Session::flash('error', 'Minimum withdrawal amount is Ksh. 10');
    redirect('/withdraw');
}

$config = require base_path('config.php');

$url = $config['daraja']['env'] == '0'
    ? 'https://sandbox.safaricom.co.ke/mpesa/b2c/v1/paymentrequest'
    : 'https://api.safaricom.co.ke/mpesa/b2c/v1/paymentrequest';

//get the certificate from the document root
$cert = file_get_contents('ProductionCertificate.cer');

$pk = openssl_get_publickey($cert);

//encrypt the password
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
    'CommandID' => 'BusinessPayment',
    'Amount' => $amount,
    'PartyA' => $config['daraja']['MPESA_B2C_SHORTCODE'],
    'PartyB' => $phone,
    'Remarks' => 'Withdrawal',
    'QueueTimeOutURL' => $config['daraja']['MPESA_TEST_URL'] . '/api/b2ccallBack',
    'ResultURL' => $config['daraja']['MPESA_TEST_URL'] . '/api/b2ccallBack',
    'Occasion' => 'Withdrawal'
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . Mpesa::B2CAuthorize(),
    'Content-Type: application/json'
]);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = json_decode(curl_exec($ch));
curl_close($ch);
// dd($response);

if (!is_string($response->ResponseCode) || $response->ResponseCode != '0') {
    Session::flash('error', $response->ResponseDescription);
    redirect('/withdraw');
}

//insert into the database table withdrawals
$db->query('INSERT INTO withdraws (user_id, amount, phone_number, tariff, description, conversation_id, transaction_date, created_at, updated_at) VALUES (:user_id, :amount, :phone_number, :tariff, :description, :conversation_id, :transaction_date, :created_at, :updated_at)', [
    'user_id' => $_SESSION['user']['id'],
    'amount' => $amount,
    'phone_number' => $phone,
    'tariff' => $tariff['tariff'],
    'description' => $response->ResponseDescription,
    'conversation_id' => $response->ConversationID,
    'transaction_date' => date('Y-m-d H:i:s'),
    'created_at' => date('Y-m-d H:i:s'),
    'updated_at' => date('Y-m-d H:i:s')
]);

Session::flash('success', 'Withdrawal request sent successfully.
    Please wait for the transaction to be processed.');

redirect('/withdraw');
