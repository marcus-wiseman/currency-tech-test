<?php

namespace App\Http\Controllers\api\v1;

use App\CurrencyConversionRate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class CurrencyController
 */
class CurrencyController extends Controller
{
    /**
     * Get all available target currecy codes.
     *
     * @return void
     */
    public function codes()
    {
        $results = [];
        $codeQuery = CurrencyConversionRate::select(['target_name', 'target_currency'])->distinct()->get();

        foreach($codeQuery as $collection) {
            $results[] = [
                'name' => $collection->target_name,
                'code' => $collection->target_currency
            ];
        }

        return response([
            'status' => true,
            'data' => $results
        ]);
    }

    /**
     * Convert an amount to another currency.
     *
     * @param Request $request
     * @return void
     */
    public function convert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:0.01',
            'base_currency' => 'required|string|max:3',
            'target_currency' => 'required|string|max:3'
        ]);

        if ($validator->fails()) {
            return response([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        $conversionRate = CurrencyConversionRate::where([
            'base_currency' => $request->input('base_currency'),
            'target_currency' => $request->input('target_currency')
        ])->first();

        if (!$conversionRate) {
            return response([
                'status' => false,
                'errors' => 'Invalid currencies.'
            ]);
        }

        $exchangeAmount = $request->input('amount') * $conversionRate->exchange_rate;

        return response([
            'status' => true,
            'amount' => number_format($exchangeAmount, 2, '.', '')
        ]);
    }
}
