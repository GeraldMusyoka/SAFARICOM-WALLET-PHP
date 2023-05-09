<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$topuptransactions = $db->query('SELECT * FROM topups where user_id = :user_id ORDER BY id DESC', [
    'user_id' => $_SESSION['user']['id']
])->get();

view('topup/index', [
    'heading' => 'Topup Transaction List',
    'topuptransactions' => $topuptransactions,
]);