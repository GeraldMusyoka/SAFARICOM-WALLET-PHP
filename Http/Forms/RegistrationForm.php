<?php

namespace Http\Forms;

use Core\Validator;

class RegistrationForm
{
    protected $errors = [];

    public function validate($name, $email, $password)
    {
        if (!Validator::string($name)) {
            $this->errors['name'] = 'Name is required';
        }

        if (empty($email) && !Validator::email($email)) {
            $this->errors['email'] = 'Enter Email that is valid';
        }

        if (!Validator::string($password, 7, 255)) {
            $this->errors['password'] = 'Provide Password of atleast 7 characters';
        }

        return empty($this->errors);
    }

    public function errors()
    {
        return $this->errors;
    }

    public function error($field, $message)
    {
        return $this->errors[$field] = $message;
    }
}
