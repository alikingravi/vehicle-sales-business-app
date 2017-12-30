<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vehicle_id')->unsigned();
            $table->decimal('buying_price', 8, 2)->default(0);
            $table->decimal('total_vehicle_cost', 8, 2)->default(0);
            $table->decimal('list_price', 8, 2)->default(0);
            $table->decimal('selling_price', 8, 2)->default(0);
            $table->decimal('profit', 8, 2)->default(0);
            $table->string('additional_notes');
            $table->tinyInteger('sale_complete');
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
        Schema::dropIfExists('sales');
    }
}
