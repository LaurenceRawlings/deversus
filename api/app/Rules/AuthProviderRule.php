<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\ImplicitRule;

class AuthProviderRule implements ImplicitRule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->providers = [
            'GitHub',
        ];
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        foreach ($this->providers as $provider) {
            if (stripos($value, $provider) !== false) return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Authenticate with a valid provider: ' . implode(', ', $this->providers);
    }
}
