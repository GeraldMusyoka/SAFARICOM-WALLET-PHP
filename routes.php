<?php

$router->get('/', 'auth/sessions/create.php')->only('guest');
$router->post('/login', 'auth/sessions/store.php');
$router->delete('/logout', 'auth/sessions/destroy.php')->only('auth');
$router->get('/register', 'auth/registration/create.php')->only('guest');
$router->post('/register', 'auth/registration/store.php')->only('guest');

$router->get('/home', 'home.php')->only('auth');

$router->get('/topup', 'topup/create.php')->only('auth');
$router->get('/topup-transactions', 'topup/index.php')->only('auth');
$router->post('/topup', 'topup/store.php')->only('auth');
$router->post('/api/stkpush', 'topup/stkpush.php');

$router->get('/withdraw', 'withdraw/create.php')->only('auth');
$router->post('/withdraw', 'withdraw/store.php')->only('auth');
$router->post('/api/b2ccallBack', 'withdraw/withdrawresponse.php');
$router->get('/withdraw-bulk', 'withdraw/bulk.php')->only('auth');
$router->post('/withdraw-bulk', 'withdraw/bulkstore.php')->only('auth');
$router->get('/withdraw-transactions', 'withdraw/index.php')->only('auth');

$router->post('/customers', 'customers/store.php')->only('auth');
$router->get('/customers', 'customers/customers.php')->only('auth');
$router->delete('/customers', 'customers/destroy.php')->only('auth');

$router->get('/tariff', 'tariff/index.php')->only('auth');
$router->post('/tariff', 'tariff/store.php')->only('auth');
$router->delete('/tariff', 'tariff/destroy.php')->only('auth');
