<?php

use Core\App;
use Core\Database;

// Get data from the callback url
$stkCallbackResponse = file_get_contents('php://input');

// Decode the JSON data 
$requestData = json_decode($stkCallbackResponse, true);

// Log message to indicate that the endpoint has been hit
error_log('Mpesa stk endpoint hit');

// Log the response 
$file = '/home2/wateregm/leowa.waterhub.africa/Http/controllers/topup/stkpush.txt';
$logFile = fopen($file, 'a');
fwrite($logFile, date('Y-m-d H:i:s') . ' Response: ' . json_encode($requestData) . PHP_EOL);
fclose($logFile);

// Extract the values 
$merchantRequestID = $requestData['Body']['stkCallback']['MerchantRequestID'];
$checkoutRequestID = $requestData['Body']['stkCallback']['CheckoutRequestID'];
$resultCode = $requestData['Body']['stkCallback']['ResultCode'];
$resultDesc = $requestData['Body']['stkCallback']['ResultDesc'];
$amount = $requestData['Body']['stkCallback']['CallbackMetadata']['Item'][0]['Value'];
$mpesaReceiptNumber = $requestData['Body']['stkCallback']['CallbackMetadata']['Item'][1]['Value'];
$balance = $requestData['Body']['stkCallback']['CallbackMetadata']['Item'][2]['Value'] ?? null;
$transactionDate = $requestData['Body']['stkCallback']['CallbackMetadata']['Item'][3]['Value'];
$phoneNumber = $requestData['Body']['stkCallback']['CallbackMetadata']['Item'][4]['Value'];

$db = App::resolve(Database::class);

// Save topup transaction topup
if($resultCode == '0') {
    $topupdata = $db->query('SELECT * FROM topups WHERE checkout_request_id = :checkout_request_id', [
            'checkout_request_id' => $checkoutRequestID
        ])->findOrFail();
    
    //update record
    $db->query('UPDATE topups SET status = :status, transaction_id = :transaction_id, transaction_type = :transaction_type, transaction_date = :transaction_date,
        description = :description, third_party_reference = :third_party_reference, amount = :amount, phone_number = :phone_number WHERE id = :id', [
        'status' => $resultCode,
        'transaction_id' => $mpesaReceiptNumber,
        'transaction_type' => 'Top up',
        'transaction_date' => date($transactionDate),
        'description' => $resultDesc,
        'third_party_reference' => 'NULL',
        'amount' => $amount,
        'phone_number' => $phoneNumber,
        'id' => $topupdata['id']
    ]);
} else {
    $db->query('UPDATE topups SET status = :status, transaction_type = :transaction_type, description = :description, third_party_reference = :third_party_reference WHERE id = :id', [
        'status' => $resultCode,
        'transaction_type' => 'Top up',
        'description' => $resultDesc,
        'third_party_reference' => 'NULL',
        'id' => $topupdata['id']
    ]);
}
