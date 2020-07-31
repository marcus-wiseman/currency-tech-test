<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrencyConversionRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currency_conversion_rates', function (Blueprint $table)
        {
            $table->id();

            $table->string('base_name', 80);
            $table->string('base_currency', 3);

            $table->string('target_name', 80);
            $table->string('target_currency', 3);

            $table->double('exchange_rate', 15, 9);
            $table->double('inverse_rate', 15, 9);

            $table->index(['base_name', 'target_name']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currency_conversion_rates');
    }
}
