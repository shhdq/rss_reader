<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExchangeRate as Rate;

class ExchangeRateController extends Controller
{
    public function index()
    {
        // If need more pages change number (2) to (20)
        $rates = Rate::paginate(2);
        return view('pages.rates.index', ['rates' => $rates]);
    }

    public function show($id)
    {
        $rate = Rate::findOrFail($id);
        $previousRates = Rate::whereDate('pub_date', '<', $rate->pub_date)->paginate(2);

        return view('pages.rates.show', [
            'rate' => $rate,
            'previousRates' => $previousRates
        ]);
    }
}