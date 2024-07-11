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
        // Prüfen, ob der Benutzername in der Brokers-Tabelle existiert
        $brokerExists = Broker::where('username', $value)
            ->where('id', '!=', $this->ignoreId)
            ->exists();

        // Prüfen, ob der Benutzername in der Sellers-Tabelle existiert
        $sellerExists = Seller::where('username', $value)
            ->where('id', '!=', $this->ignoreId)
            ->exists();

        // Rückgabe true, wenn der Benutzername weder in Brokers noch in Sellers existiert
        return !$brokerExists && !$sellerExists;
    }

    public function message()
    {
        return 'The username has already been taken.';
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$this->passes($attribute, $value)) {
            $fail($this->message());
        }
    }
}
