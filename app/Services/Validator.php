<?php

namespace App\Services;

use Illuminate\Validation\Validator;
use Illuminate\Support\Arr;


class CustomValidator extends Validator {

    public function validateDifferentmultiple($attribute, $value, $parameters, $validator) {
        foreach($parameters as $parameter) {
            $other = Arr::get($this->data, $parameter);
            if (isset($other) && $value === $other) return FALSE;
        }

        return TRUE;
    }
}
