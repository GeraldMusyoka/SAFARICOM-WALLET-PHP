<?php

namespace Http\Forms;

use Core\Validator;

class WithdrawForm
{
    protected $errors = [];

    public function validate($phone, $amount)
    {
        if (empty($phone) && !Validator::integer($phone)) {
            $this->errors['phone'] = 'Enter a valid phone number';
        }

        if (empty($amount) && !Validator::integer($amount)) {
            $this->errors['amount'] = 'Enter a valid amount';
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
