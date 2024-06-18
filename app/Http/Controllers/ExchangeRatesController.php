<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ExchangeRatesController extends Controller
{
    public function index()
    {
        try {
            $client = new Client();

            // Cash rates
            $cashResponse = $client->request('GET', 'https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5');
            $cashData = json_decode($cashResponse->getBody(), true);
            $cashCurrencies = $cashData;

            // Non cash rates
            $nonCashResponse = $client->request('GET', 'https://api.privatbank.ua/p24api/pubinfo?exchange&json&coursid=11');
            $nonCashData = json_decode($nonCashResponse->getBody(), true);
            $nonCashCurrencies = $nonCashData;

            return view('exchange.index', compact('cashCurrencies', 'nonCashCurrencies'));
        } catch (RequestException $e) {
            $errorMessage = 'Error when receiving data from Privatbank: ' . $e->getMessage();
            return view('exchange.error', compact('errorMessage'));
        }
    }
}
