<?php

use Core\Authenticator;
use Core\Session;
use Http\Forms\LoginForm;

$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();

if ($form->validate($email, $password)) {
    $auth = new Authenticator();

    if ($auth->attempt($email, $password)) {
        redirect('/home');
    }

    $form->error('email', 'No matching record found');
}

Session::flash('errors', $form->errors());

return redirect('/');
