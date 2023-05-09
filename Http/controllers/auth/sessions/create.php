<?php

use Core\Session;

view('auth/login', [
    'heading' => 'Login',
    'errors' => Session::get('errors'),
]);