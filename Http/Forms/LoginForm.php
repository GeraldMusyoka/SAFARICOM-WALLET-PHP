<?php

namespace Http\Forms;

use Core\Validator;

class LoginForm
{
    protected $errors = [];

    public function validate($email, $password)
    {
        if (empty($email) && !Validator::email($email)) {
            $this->errors['email'] = 'Enter Email that is valid';
        }
        
        if (!Validator::string($password)) {
            $this->errors['password'] = 'Provide a valid Password';
        }

        return empty($this->errors);
    }

    public function errors()
    {
        return $this->errors;
    }

    public function error($field, $message)
    {
        $this->errors[$field] = $message;
    }
}