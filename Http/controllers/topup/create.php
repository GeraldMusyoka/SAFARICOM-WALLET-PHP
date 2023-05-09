<?php

use Core\Session;

view('topup/create', [
    'heading' => 'Topup',
    'errors' => Session::get('errors'),
    'error' => Session::get('error'),
    'success' => Session::get('success'),
]);