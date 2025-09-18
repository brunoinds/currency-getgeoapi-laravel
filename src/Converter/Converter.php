<?php

namespace Brunoinds\CurrencyGetGetApiLaravel\Converter;

use Brunoinds\CurrencyGetGetApiLaravel\Store\Store;
use DateTime;
use Carbon\Carbon;


class Converter{
    public static Store|null $store = null;
    public static function convertFromTo(DateTime $date, float $amount, string $from, string $to)
    {
        $rate = Converter::fetchConvertionRate($date, $from, $to);
        return $rate * $amount;
    }
    private static function fetchConvertionRate(DateTime $date, string $from, string $to)
    {
        if ($date->format('Y-m-d') > Carbon::now()->timezone('America/Lima')->format('Y-m-d')){
            $date = Carbon::now()->timezone('America/Lima')->toDateTime();
        }

        $dateString = $date->format('Y-m-d');

        $curl = curl_init();


        $apiKey = env('CURRENCY_GETGEO_API_KEY');
        if (!$apiKey) {
            throw new \Exception('CURRENCY_GETGEO_API_KEY environment variable is not set');
        }


        $curlURL = 'https://api.getgeoapi.com/v2/currency/historical/' . $dateString . '?' . http_build_query([
            'api_key' => $apiKey,
            'from' => $from,
            'to' => $to,
            'amount' => 1,
            'format' => 'json'
        ]);


        $storeKey = $dateString . '_' . $from . '_' . $to;

        $stores = [];
        $cachedValue = Converter::$store->get();
        if ($cachedValue){
            $stores = json_decode($cachedValue, true);
            if (isset($stores[$storeKey])){
                return $stores[$storeKey];
            }
        }


        curl_setopt_array($curl, [
            CURLOPT_URL => $curlURL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 2,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ]);

        $response = curl_exec($curl);
        curl_close($curl);
        $results = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception('Invalid JSON response: "' . json_last_error_msg(). '". The API response was: ' . $response);
        }

        try {
            $rate = $results['rates'][$to]['rate'];
            $stores[$storeKey] = (float) $rate;
            Converter::$store->set(json_encode($stores));
            return (float) $rate;
        } catch (\Throwable $th) {
            throw new \Exception('Error while parsing the conversion rate. The API response was: ' . $response);
        }
    }
}
