<?php

use Core\App;
use Core\Session;
use Core\Response;
use Core\Database;

function dd($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
    die();
}

function urlIs($value)
{
    return $_SERVER['REQUEST_URI'] === $value;
}

function base_path($path)
{
    return BASE_PATH . $path;
}

function view($path, $data = [])
{
    extract($data);

    return require base_path("views/pages/{$path}.view.php");
}

function abort($code = Response::NOT_FOUND)
{
    http_response_code($code);

    require base_path("views/pages/{$code}.php");
    die();
}

function authorize($condition, $status = Response::FORBIDDEN)
{
    if (!$condition) {
        abort($status);
    }
}

function logout()
{
    Session::destroy();
}

function redirect($path)
{
    header("Location: {$path}");
    
    exit();
}

function wallet($user)
{
    $db = App::resolve(Database::class);
    $userdata = $db->query('SELECT * FROM users WHERE id = :id', [
        'id' => $user
    ])->findOrFail();
    
    return $userdata['wallet_balance'] ?? '0.0';
}
