<?php

namespace App\Services;

use App\Models\Currency;
use Carbon\Carbon;

class CurrencyConversion
{
    const DEFAULT_CURRENCY_SLUG = 'RUB';

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

    public static function convert($sum, $originCurrencySlug = self::DEFAULT_CURRENCY_SLUG, $targetCurrencySlug = null)
    {
        self::loadContainer();

        $originCurrency = self::$container[$originCurrencySlug];

        if($originCurrency->slug != self::DEFAULT_CURRENCY_SLUG) {
            //       if($originCurrency->rate == 0 || $originCurrency->updated_at->startOfDay() != Carbon::now()->startOfDay()) {
//            CurrencyRates::getRates();
//            self::loadContainer();
//            $originCurrency = self::$container[$originCurrencySlug];
//        }
        }


        if(is_null($targetCurrencySlug)) {
            $targetCurrencySlug = self::getCurrencyFromSession();
        }

        $targetCurrency = self::$container[$targetCurrencySlug];

//        if($targetCurrency->rate == 0 || $targetCurrency->updated_at->startOfDay() != Carbon::now()->startOfDay()) {
//            CurrencyRates::getRates();
//            self::loadContainer();
//            $targetCurrency = self::$container[$targetCurrencySlug];
//        }

        return $sum / $originCurrency->rate * $targetCurrency->rate;
    }


    public static function getCurrencySymbol()
    {
        self::loadContainer();

        $currencySlugFromSession = self::getCurrencyFromSession();
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

    public static function getCurrencyFromSession()
    {
        return session('currency_slug', self::DEFAULT_CURRENCY_SLUG);
    }

    public static function getCurrentCurrencyFromSession()
    {
        self::loadContainer();

        $currencySlug = self::getCurrencyFromSession();

        foreach (self::$container as $currency) {
            if($currency->slug === $currencySlug) {
                return $currency;
            }
        }
    }
}
