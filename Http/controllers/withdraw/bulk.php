<?php

use Core\App;
use Core\Session;
use Core\Database;

$db = App::resolve(Database::class);
$customers = $db->query('SELECT * FROM customers WHERE user_id = :user_id', [
    'user_id' => $_SESSION['user']['id']
])->get();

$tariffs = $db->query('SELECT * FROM tariffs')->get();

view('withdraw/bulk', [
    'heading' => 'Bulk Withdraw',
    'errors' => Session::get('errors'),
    'error' => Session::get('error'),
    'success' => Session::get('success'),
    'customers' => $customers,
    'tariffs' => $tariffs
]);