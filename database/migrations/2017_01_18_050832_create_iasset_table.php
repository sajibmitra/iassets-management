<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIassetTable extends Migration
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
            $table->string('iasset_id');
            $table->string('unique_office_id')->unique();
            $table->string('serial_id');
            $table->string('product_id');
            $table->string('type');
            $table->string('brand');
            $table->string('model');
            $table->timestamp('purchase_at')->nullable();
            $table->timestamp('entry_at')->nullable();
            $table->integer('warranty');
            $table->string('status');
            $table->integer('iuser_id')->unsigned();
            $table->integer('ivendor_id')->unsigned();
            $table->timestamps();
            $table->foreign('iuser_id')->references('id')->on('iusers')->onDelete('cascade');
            $table->foreign('ivendor_id')->references('id')->on('ivendors')->onDelete('cascade');
        });
        Schema::create('iasset_iuser', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('iasset_id')->unsigned();
            $table->integer('iuser_id')->unsigned();
            $table->timestamps();

            $table->foreign('iasset_id')
                ->references('id')
                ->on('iassets')
                ->onDelete('cascade');
            $table->foreign('iuser_id')
                ->references('id')
                ->on('iusers')
                ->onDelete('cascade');
        });
   }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('iasset_iuser');
        Schema::drop('iassets');
    }
}
