<?php

namespace App\Rules;

use Closure;
use App\Models\Broker;
use App\Models\Seller;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueUsername implements ValidationRule
{


    protected $ignoreId;

    public function __construct($ignoreId = null)
    {
        $this->ignoreId = $ignoreId;
    }


    public function passes($attribute, $value)
    {
        $brokerExists = Broker::where('username', $value)
            ->where('id', '!=', $this->ignoreId)
            ->exists();

        $sellerExists = Seller::where('username', $value)->exists();

        return !$brokerExists && !$sellerExists;
    }

    public function message()
    {
        return 'The username has already been taken.';
    }


    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }
}
