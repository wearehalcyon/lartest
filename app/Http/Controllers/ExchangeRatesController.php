<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExchangeRatesController extends Controller
{
    public function index()
    {
        return view('exchange.index');
    }
}
