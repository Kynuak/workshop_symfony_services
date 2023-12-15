<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class ConvertorMoney
{
    private const APIKEY = "bca28685fd0db28897d4bc00";

    public function __construct(
        private HttpClientInterface $client,
    ) {
    }

    public function convertEurTo(float $euroPrice, string $money): float
    {
        $response = $this->client->request(
            'GET',
            'https://v6.exchangerate-api.com/v6/'.self::APIKEY.'/pair/EUR/'.$money
        );

        $content = $response->toArray();
        $conversionRate = $content['conversion_rate'];

        return round($euroPrice * $conversionRate, 2);
    }

}