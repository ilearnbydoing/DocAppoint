<?php

namespace Stripe;

class ExchangeRateTest extends TestCase
{
    public function testIsListable()
    {
        $this->stubRequest(
            'get',
            '/v1/exchange_rates',
            [],
            null,
            false,
            [
                'object' => 'list',
                'data' => [
                    [
                        'id' => 'eur',
                        'object' => 'exchange_rate',
                        'rates' => ['cad' => 1.18221],
                    ],
                    [
                        'id' => 'cad',
                        'object' => 'exchange_rate',
                        'rates' => ['eur' => 0.845876],
                    ],
                ],
            ]
        );

        $listRates = ExchangeRate::all();
        $this->assertTrue(is_array($listRates->data));
        $this->assertEquals('exchange_rate', $listRates->data[0]->object);
    }

    public function testIsRetrievable()
    {
        $this->stubRequest(
            'get',
            '/v1/exchange_rates/cad',
            [],
            null,
            false,
            [
                'id' => 'cad',
                'object' => 'exchange_rate',
                'rates' => ['eur' => 0.845876],
            ]
        );
        $rates = ExchangeRate::retrieve("cad");
        $this->assertEquals('exchange_rate', $rates->object);
    }
}
