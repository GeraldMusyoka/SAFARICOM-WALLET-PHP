<?php

use Core\App;
use Core\Session;
use Core\Database;

$db = App::container()->resolve(Database::class);

$tariff = $db->query('SELECT * FROM tariffs WHERE id = :id', [
    'id' => $_POST['id']
])->findOrFail();

$db->query('DELETE FROM tariffs WHERE id = :id', [
    'id' => $_POST['id']
]);

Session::flash('success', 'Tariff deleted successfully');

return redirect('/tariff');