<?php

namespace Http\Forms;

use Core\Validator;

class TariffForm
{
    protected $errors = [];

    public function validate($min, $max, $tariff)
    {
        if (empty($min) && !Validator::integer($min)) {
            $this->errors['min'] = 'Enter a valid minimum amount';
        }

        if (empty($max) && !Validator::integer($max)) {
            $this->errors['max'] = 'Enter a valid minimum amount';
        }

        if (empty($max) && !Validator::integer($tariff)) {
            $this->errors['tariff'] = 'Enter a valid Tariff amount';
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