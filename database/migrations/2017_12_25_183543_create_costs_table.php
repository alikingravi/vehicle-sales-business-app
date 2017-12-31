<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('costs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vehicle_id')->unsigned();
//            $table->foreign('vehicle_id')->references('id')->on('vehicles');
            $table->decimal('car_valet', 8, 2)->default(0);
            $table->decimal('mot', 8, 2)->default(0);
            $table->decimal('windscreen', 8, 2)->default(0);
            $table->decimal('dents_scratches', 8, 2)->default(0);
            $table->decimal('oil_filter', 8, 2)->default(0);
            $table->decimal('fuel_topup', 8, 2)->default(0);
            $table->decimal('tyres', 8, 2)->default(0);
            $table->decimal('timing_chain', 8, 2)->default(0);
            $table->decimal('vat', 8, 2)->default(0);
            $table->decimal('other_costs', 8, 2)->default(0);
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
        Schema::dropIfExists('costs');
    }
}
