<?php

use Core\App;
use Core\Database;

//get data from the callback url
$withdrawCallbackResponse = file_get_contents('php://input');

// Decode the JSON data 
$requestData = json_decode($withdrawCallbackResponse, true);

// Log message to indicate that the endpoint has been hit
error_log('Mpesa withdraw endpoint hit');

// Log the request data to a file 
$file = '/home2/wateregm/leowa.waterhub.africa/Http/controllers/withdraw/withdraw.txt';
$logFile = fopen($file, 'a');
fwrite($logFile, date('Y-m-d H:i:s') . ' Response: ' . json_encode($requestData) . PHP_EOL);
fclose($logFile);

//Extract values
$conversationID = $requestData['Result']['ConversationID'];
$transactionID = $requestData['Result']['TransactionID'];
$resultCode = $requestData['Result']['ResultCode'];
$resultDesc = $requestData['Result']['ResultDesc'];

$db = App::resolve(Database::class);

$withdrawData = $db->query('SELECT * FROM withdraws WHERE conversation_id = :conversation_id', [
    'conversation_id' => $conversationID  
])->findOrFail();
    
//Save transaction
if($resultCode == '0') {
    //update record
    $db->query('UPDATE withdraws SET status = :status, transaction_id = :transaction_id, transaction_type = :transaction_type, updated_at = :updated_at,
        description = :description WHERE id = :id', [
        'status' => $resultCode,
        'transaction_id' => $transactionID,
        'transaction_type' => 'Withdraw',
        'updated_at' => date("Y-m-d H:i:s"),
        'description' => $resultDesc,
        'id' => $withdrawData['id']
    ]);
    
    //user data
    $user = $db->query('SELECT * FROM users WHERE id = :id', [
        'id' => $withdrawData['user_id']    
    ])->findOrFail();
    
    $amountDeductible = $withdrawData['amount'] + $withdrawData['tariff'];
    $currentBalance = $user['wallet_balance'];
    $newBalance = $currentBalance - $amountDeductible;
    
    //update wallet Balance
    $db->query('UPDATE users SET wallet_balance = :wallet_balance WHERE id = :id', [
        'wallet_balance' => $newBalance,
        'id' => $withdrawData['user_id']
    ]);
    error_log('New wallet balance: KES ' . $newBalance);
}
//update record
$db->query('UPDATE withdraws SET status = :status, transaction_id = :transaction_id, transaction_type = :transaction_type,
    description = :description WHERE id = :id', [
    'status' => $resultCode,
    'transaction_id' => $transactionID,
    'transaction_type' => 'Withdraw',
    'description' => $resultDesc,
    'id' => $withdrawData['id']
]);

