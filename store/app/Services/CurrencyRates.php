<?php

namespace App\Services;

use GuzzleHttp\Client;

class CurrencyRates
{
    public static function getRates()
    {
        $baseCurrencySlug = CurrencyConversion::getBaseCurrency()->slug;

        $url = config('currency_rates.api_url') . '?' . 'apikey=' . config('currency_rates.api_key') . '&base_currency=' . $baseCurrencySlug;

        $client = new Client();

        $response = $client->request('GET', $url);

        if($response->getStatusCode() !== 200) {
            throw new \Exception('There is a problem with currency rate service');
        }

        $rates = json_decode($response->getBody()->getContents(), true)['data'];

        foreach (CurrencyConversion::getCurrencies() as $currency) {
            if(!$currency->isMain()) {
                if(!isset($rates[$currency->slug])) {
                    throw new \Exception('There is a problem with currency ' . $currency->slug);
                }else {
                    $currency->update([
                        'rate' => $rates[$currency->slug]['value']
                    ]);

                    $currency->touch();
                }
            }
        }

        session()->flash('success', 'Курс валюты успешно обновлен!');
    }
}
