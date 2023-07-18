<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidChannelUrlFormat implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        /* Only accept the following URL patterns:
            - https://rumble.com/c/{id}
            - https://rumble.com/c/{id}/
        */
        $pattern = "/^https?:\/\/rumble\.com\/c\/\w+(\/)?$/";

        $isValid = 1 === preg_match($pattern, $value);

        $id = str_replace('https://rumble.com/c/', '', $value);
        
        if (!$isValid || '' === $id) {
            $fail('Invalid rumble channel URL. Please adhere to the following standard: https://rumble.com/c/{channel_id} | https://rumble.com/c/{channel_id}/');
        }
    }
}