<?php

use Core\App;
use Core\Session;
use Core\Database;
use Core\Mpesa;

$errors = [];

$selectedCustomers = array_filter($_POST['customers'] ?? [], function ($customer) {
    return !empty($customer['id']);
});

if (empty($selectedCustomers)) {
    $errors['checkbox'] = 'Please select at least one customer';
}

foreach ($selectedCustomers as $customerId => $customer) {
    if (empty($customer['amount'])) {
        $errors['amount'][$customerId] = 'Please enter an amount for this customer';
    } elseif (!is_numeric($customer['amount']) || $customer['amount'] <= 0) {
        $errors['amount'][$customerId] = 'Invalid amount for this customer';
    }
}

if (!empty($errors)) {
    Session::flash('errors', $errors);
    redirect('/withdraw-bulk');
}

$selectedCustomersIds = array_map(function ($customer) {
    return $customer['id'];
}, $selectedCustomers);

$totalAmount = array_reduce($selectedCustomers, function ($currentSum, $customer) {
    return $currentSum + $customer['amount'];
}, 0);

$db = App::resolve(Database::class);

$user = $db->query('SELECT * FROM users WHERE id = :id', [
    'id' => $_SESSION['user']['id']
])->find();

$walletBalance = $user['wallet_balance'];

$tariff = $db->query('SELECT * FROM tariffs WHERE min <=:totalamount AND max >= :totalamount', [
    'totalamount' => $totalAmount
])->find();

if ($totalAmount + $tariff['tariff'] > $walletBalance) {
    Session::flash('error', 'Insufficient funds in your wallet.');
    redirect('/withdraw-bulk');
} elseif ($totalAmount <= 10) {
    Session::flash('error', 'Minimum withdrawal amount should be more than Ksh. 10');
    redirect('/withdraw-bulk');
}

//loop through each customer to process withdrawals
foreach ($selectedCustomers as $customerData) {
    $customer = $db->query('SELECT * FROM customers WHERE id = :id', [
        'id' => $customerData['id']
    ])->find();

    $amount = $customerData['amount'];
    $phone = $customer['phone'];
    $remarks = 'CUSTOMER DISBURSEMENT';

    //get customer amount tariff
    $customerTariff = $db->query('SELECT * FROM tariffs WHERE min <=:amount AND max >= :amount', [
        'amount' => $amount
    ])->find();

    $tariffAmount = $customerTariff['tariff'];

    //process withdraw transaction
    $disbursement = Mpesa::withdraw($phone, $amount, $remarks);
    
    if(!is_string($disbursement->ResponseCode) || $disbursement->ResponseCode != '0') {
        Session::flash('error', 'Bulk withdrawal failed, please try again later.');
        redirect('/withdraw-bulk');
    }
    
    //save the transaction in the withdraws table
    if ($disbursement->ResponseCode === '0') {
        $db->query('INSERT INTO withdraws (user_id, phone_number, amount, tariff, description, conversation_id, transaction_date, created_at, updated_at) VALUES (:user_id, :phone_number, :amount, :tariff, :description, :conversation_id, :transaction_date, :created_at, :updated_at)', [
            'user_id' => $_SESSION['user']['id'],
            'phone_number' => $phone,
            'amount' => $amount,
            'tariff' => $tariffAmount,
            'description' => $remarks,
            'conversation_id' => $disbursement->ConversationID,
            'transaction_date' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}

$db->query('INSERT INTO disbursements (user_id, customers, amount, created_at, updated_at) VALUES (:user_id, :customers, :amount, :created_at, :updated_at)', [
    'user_id' => $_SESSION['user']['id'],
    'customers' => json_encode($selectedCustomersIds),
    'amount' => $totalAmount,
    'created_at' => date('Y-m-d H:i:s'),
    'updated_at' => date('Y-m-d H:i:s')
]);

Session::flash('success', 'Bulk withdrawal processed successfully.');
redirect('/withdraw-bulk');
