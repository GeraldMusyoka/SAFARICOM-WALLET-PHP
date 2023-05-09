<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::container()->resolve(Database::class);

$customer = $db->query('SELECT * FROM customers WHERE id = :id', [
    'id' => $_POST['id']
])->findOrFail();
    
authorize($customer['user_id'] === $_SESSION['user']['id']);

$db->query('DELETE FROM customers WHERE id = :id', [
    'id' => $_POST['id']
]);

Session::flash('success', 'Customer deleted successfully');

return redirect('/customers');
