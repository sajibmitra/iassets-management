<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIassetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iassets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('asset_id')->nullable();
            $table->string('serial_id');
            $table->string('product_id');
            $table->string('type'); 
            $table->string('brand');
            $table->string('model');            
            $table->timestamp('purchase_at')->nullable();
            $table->timestamp('entry_at')->nullable();
            $table->integer('warranty');
            $table->string('status');
            $table->string('section');
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
        Schema::dropIfExists('iassets');
    }
}
