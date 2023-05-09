<?php

use Core\App;
use Core\Session;
use Core\Database;

$db = App::resolve(Database::class);
$tariffs = $db->query('SELECT * FROM tariffs')->get();

view('withdraw/create', [
    'heading' => 'Withdraw',
    'errors' => Session::get('errors'),
    'error' => Session::get('error'),
    'success' => Session::get('success'),
    'tariffs' =>  $tariffs
]);