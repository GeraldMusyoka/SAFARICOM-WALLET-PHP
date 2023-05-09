<?php

use Core\App;
use Core\Authenticator;
use Core\Database;
use Core\Session;
use Core\Validator;
use Http\Forms\RegistrationForm;

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$user_id = '2';

$form = new RegistrationForm();

if ($form->validate($name, $email, $password)) {
    $db = App::resolve(Database::class);

    $user = $db->query('SELECT * FROM users WHERE email = :email', [
        'email' => $email,
    ])->find();

    if (!$user) {
        $db->query('INSERT INTO users (name, email, password, role_id, created_at) VALUES (:name, :email, :password, :user_id, :date)', [
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'user_id' => $user_id,
            'date' => date('Y-m-d H:i:s'),
        ]);

        $auth = new Authenticator();
        $auth->login([
            'name' => $user['name'],
            'email' => $user['email'],
            'role_id' => $user['role_id'],
            'id' => $user['id'],
            'wallet_balance' => $user['wallet_balance']
        ]);

        return redirect('/home');
    }

    $form->error('email', 'Email already exists');
}

Session::flash('errors', $form->errors());

return redirect('/register');
