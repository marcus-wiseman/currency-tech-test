<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ConversionRates extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $conversionRatesData = file_get_contents('http://www.floatrates.com/daily/gbp.xml');
        } catch (Exception $e) {
            Log::alert($e->getMessage());
            exit;
        }

        if (empty($conversionRatesData)) {
            Log::alert('Conversion rates data is empty.');
        }

        try {
            $xmlObject = simplexml_load_string($conversionRatesData, "SimpleXMLElement", LIBXML_NOCDATA);
            $jsonObject = json_encode($xmlObject);
            $conversionsArray = json_decode($jsonObject, true);
        } catch (Exception $e) {
            Log::alert($e->getMessage());
            exit;
        }

        foreach($conversionsArray as $conversion) {
            if (is_array($conversion)) {
                foreach($conversion as $rate) {
                    DB::table('currency_conversion_rates')->insert([
                        'base_name' => $rate['baseName'],
                        'base_currency' => $rate['baseCurrency'],
                        'target_name' => $rate['targetName'],
                        'target_currency' => $rate['targetCurrency'],
                        'exchange_rate' => str_replace(',', '', $rate['exchangeRate']),
                        'inverse_rate' => str_replace(',', '', $rate['inverseRate'])
                    ]);
                }
            }
        }

    }
}
