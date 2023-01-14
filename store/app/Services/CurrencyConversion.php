<?php

namespace App\Services;

use App\Models\Currency;
use Carbon\Carbon;

class CurrencyConversion
{
    protected static array $container = [];

    public static function loadContainer()
    {
        if(empty(self::$container)) {
            $currencies = Currency::get();

            foreach ($currencies as $currency) {
                self::$container[$currency->slug] = $currency;
            }
        }
    }

    public static function getCurrencies()
    {
        self::loadContainer();

        return self::$container;
    }

    public static function convert($sum, $originCurrencySlug = 'RUB', $targetCurrencySlug = null)
    {
        self::loadContainer();

        $originCurrency = self::$container[$originCurrencySlug];

        if($originCurrency->rate == 0 || $originCurrency->updated_at->startOfDay() != Carbon::today()) {
            CurrencyRates::getRates();
            self::loadContainer();
            $originCurrency = self::$container[$originCurrencySlug];
        }

        if(is_null($targetCurrencySlug)) {
            $targetCurrencySlug = session('currency_slug', 'RUB');
        }


        $targetCurrency = self::$container[$targetCurrencySlug];
        if($targetCurrency->rate == 0 || $targetCurrency->updated_at->startOfDay() != Carbon::today()) {
            CurrencyRates::getRates();
            self::loadContainer();
            $targetCurrency = self::$container[$targetCurrencySlug];
        }

        return $sum / $originCurrency->rate * $targetCurrency->rate;
    }


    public static function getCurrencySymbol()
    {
        self::loadContainer();

        $currencySlugFromSession = session('currency_slug', 'RUB');
        $currency = self::$container[$currencySlugFromSession];

        return $currency->symbol;
    }

    public static function getBaseCurrency()
    {
        self::loadContainer();

        foreach (self::$container as $slug => $currency) {
            if($currency->isMain()) {
                return $currency;
            }
        }
    }
}
