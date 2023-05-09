<?php

use Core\App;
use Core\Database;
use Core\Session;
use Http\Forms\TariffForm;

$min = $_POST['min'];
$max = $_POST['max'];
$tariff = $_POST['tariff'];

$db = App::resolve(Database::class);

$form = new TariffForm();

if (!$form->validate($min, $max, $tariff)) {
    Session::flash('errors', $form->errors());

    redirect('/tariff');
}

$db->query('INSERT INTO tariffs (min, max, tariff, created_at) VALUES (:min, :max, :tariff, :date)', [
    'min' => $min,
    'max' => $max,
    'tariff' => $tariff,
    'date' => date('Y-m-d H:i:s'),
]);

Session::flash('success', 'Tariff created successfully');

return redirect('/tariff');
