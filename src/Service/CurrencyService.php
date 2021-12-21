<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class CurrencyService
{
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getLocale(string $currency): string
    {
        switch ($currency) {
            case 'USD':
            case 'GBP':
                $locale = 'en';
                break;
            case 'JPY':
                $locale = 'jp';
                break;
            default:
                $currency = 'EUR';
                $locale = 'fr';
        }

        return $locale;
    }

    public function convertPrice(float $price, string $currency): float
    {
        if ($currency === 'EUR') {
            return $price;
        }
        $response = $this->client->request(
            'GET',
            "https://v6.exchangerate-api.com/v6/9fb4ceeac8bee84379558c83/pair/EUR/$currency"
        );
        $content = $response->toArray();

        return $price * $content['conversion_rate'];
    }
}
