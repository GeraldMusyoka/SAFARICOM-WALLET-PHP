<?php

use Core\App;
use Core\Session;
use Core\Database;

$db = App::resolve(Database::class);

$tariffs = $db->query('SELECT * FROM tariffs')->get();

view('tariff/tariff', [
    'heading' => 'Tariff',
    'errors' => Session::get('errors'),
    'success' => Session::get('success'),
    'tariffs' => $tariffs
]);