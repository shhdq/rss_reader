<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
    protected $guarded = ['id'];

    public function getBaseCurrencyAttribute()
    {
        return 'EUR';
    }

    public function getFormattedRatesAttribute()
    {
        return array_filter(array_chunk(explode(' ', str_replace("\"", "", $this->cdata)), 2), function ($item) {
            return count($item) === 2;
        });
    }
}
