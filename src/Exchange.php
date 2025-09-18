<?php

namespace Brunoinds\CurrencyGetGetApiLaravel;


use DateTime;
use Brunoinds\CurrencyGetGetApiLaravel\ExchangeDate\ExchangeDate;
use Brunoinds\CurrencyGetGetApiLaravel\Store\Store;
use Brunoinds\CurrencyGetGetApiLaravel\Converter\Converter;

class Exchange{
    public static function on(DateTime $date): ExchangeDate
    {
        return new ExchangeDate($date);
    }
    public static function now():ExchangeDate{
        return new ExchangeDate(new DateTime());
    }

    public static function useStore(Store $store) :void
    {
        Converter::$store = $store;
    }
}
