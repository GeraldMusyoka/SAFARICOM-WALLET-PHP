<?php

use Core\App;
use Core\Session;
use Core\Database;

$db = App::resolve(Database::class);

$errors = [];
$currentUser = $_SESSION['user']['id'];

$customers = $db->query('SELECT * FROM customers WHERE user_id = :user_id', [
    'user_id' => $currentUser
])->get();

view('customer/customers', [
    'heading' => 'Customers',
    'errors' => $errors,
    'success' => Session::get('success'),
    'customers' => $customers
]);
