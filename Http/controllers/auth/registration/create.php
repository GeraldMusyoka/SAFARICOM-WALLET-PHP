<?php

use Core\Session;

view('auth/register', [
    'heading' => 'Register',
    'errors' => Session::get('errors'),
]);

