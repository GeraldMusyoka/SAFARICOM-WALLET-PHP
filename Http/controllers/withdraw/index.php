<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$withdrawtransactions = $db->query('SELECT * FROM withdraws where user_id = :user_id', [
    'user_id' => $_SESSION['user']['id']
])->get();

view('withdraw/index', [
    'heading' => 'Withdraw Transactions',
    'withdrawtransactions' => $withdrawtransactions,
]);