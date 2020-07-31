<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurrencyConversionRate extends Model
{
    protected $fillable = [
        'base_name',
        'base_currency',
        'target_name',
        'target_currency',
        'exchange_rate',
        'inverse_rate'
    ];
}
