<?php

namespace App\Services;

use App\Models\Currency;

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
        return self::$container;
    }

    public static function convert($sum, $originCurrencySlug = 'RUB', $targetCurrencySlug = null)
    {
        self::loadContainer();

        $originCurrency = self::$container[$originCurrencySlug];

        if(is_null($targetCurrencySlug)) {
            $targetCurrencySlug = session('currency_slug', 'RUB');
        }

        $targetCurrency = self::$container[$targetCurrencySlug];

        return $sum * $originCurrency->rate / $targetCurrency->rate;
    }


    public static function getCurrencySymbol()
    {
        self::loadContainer();

        $currencySlugFromSession = session('currency_slug', 'RUB');
        $currency = self::$container[$currencySlugFromSession];

        return $currency->symbol;
    }
}
