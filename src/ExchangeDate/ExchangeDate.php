<?php

namespace Brunoinds\CurrencyGetGetApiLaravel\ExchangeDate;

use Brunoinds\CurrencyGetGetApiLaravel\Converter\Converter;
use Brunoinds\CurrencyGetGetApiLaravel\Enums\Currency;
use Brunoinds\CurrencyGetGetApiLaravel\ExchangeTransaction\ExchangeTransaction;
use DateTime;
use Brunoinds\CurrencyGetGetApiLaravel\Store\Store;

class ExchangeDate{
    public DateTime $date;

    public function __construct(DateTime $date){
        if (!Converter::$store){
            Converter::$store = Store::newFromLaravelCache();
        }

        $this->date = $date;
    }

    public function convert(Currency $currency, float $amount): ExchangeTransaction{
        return new ExchangeTransaction($this, $currency, $amount);
    }
}
