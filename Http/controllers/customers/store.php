<?php

use Core\App;
use Core\Database;
use Core\Session;
use Core\Validator;

$db = App::resolve(Database::class);

$errors = [];
$currentUser = $_SESSION['user']['id'];

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

if (!Validator::string($name)) {
    $errors['name'] = 'Name is required';
}

if (empty($email) && !Validator::email($email)) {
    $errors['email'] = 'Enter Email that is valid';
}

if (!Validator::string($phone)) {
    $errors['phone'] = 'Phone is required';
}

if (!empty($errors)) {
    view('customer/customers', [
        'heading' => 'Customers',
        'errors' => $errors,
    ]);

    die();
}

if (empty($errors)) {
    $db->query('INSERT INTO customers (name, email, phone, user_id, created_at) VALUES (:name, :email, :phone, :user, :date)', [
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'user' => $currentUser,
        'date' => date('Y-m-d H:i:s')
    ]);

    Session::flash('success', 'Customer added successfully');

    return redirect('/customers');
}