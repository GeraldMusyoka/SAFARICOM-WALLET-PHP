<?php

namespace Core;

use Core\App;
use Core\Database;

class Authenticator
{
    public function attempt($email, $password)
    {
        $user = App::resolve(Database::class)->query('SELECT * FROM users WHERE email = :email', [
            'email' => $email,
        ])->find();
        if ($user && password_verify($password, $user['password'])) {
            $this->login([
                'name' => $user['name'],
                'email' => $user['email'],
                'role_id' => $user['role_id'],
                'id' => $user['id'],
                'wallet_balance' => $user['wallet_balance']
            ]);

            return true;
        }

        return false;
    }

    public function login($user)
    {
        $_SESSION['user'] = [
            'name' => $user['name'],
            'email' => $user['email'],
            'role_id' => $user['role_id'],
            'id' => $user['id'],
            'wallet' => $user['wallet_balance']
        ];

        session_regenerate_id(true);
    }

    public function logout()
    {
        $_SESSION = [];
        session_destroy();

        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
}
