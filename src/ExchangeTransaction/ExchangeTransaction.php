<?php

namespace Brunoinds\CurrencyGetGetApiLaravel\ExchangeTransaction;

use Brunoinds\CurrencyGetGetApiLaravel\Converter\Converter;
use Brunoinds\CurrencyGetGetApiLaravel\Enums\Currency;
use Brunoinds\CurrencyGetGetApiLaravel\ExchangeDate\ExchangeDate;

class ExchangeTransaction
{
    private ExchangeDate $exchangeDate;
    private Currency $currency;
    private float $amount;

    public function __construct(ExchangeDate $exchangeDate, Currency $currency, float $amount)
    {
        $this->exchangeDate = $exchangeDate;
        $this->currency = $currency;
        $this->amount = $amount;
    }

    public function to(Currency $currency): float
    {
        if ($this->currency === $currency) {
            return $this->amount;
        }

        return Converter::convertFromTo($this->exchangeDate->date, $this->amount, $this->currency->value, $currency->value);

        throw new \Exception('Invalid currency');
    }
}
