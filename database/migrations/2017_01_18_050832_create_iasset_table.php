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
            $table->string('section');
            $table->integer('user_id')->unsigned();
            $table->integer('ivendor_id')->unsigned();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ivendor_id')->references('id')->on('ivendors')->onDelete('cascade');
        });
        Schema::create('iasset_user', function (Blueprint $table) {
            $table->integer('iasset_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->timestamps();

            $table->foreign('iasset_id')
                ->references('id')
                ->on('iassets')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::drop('iasset_user');
        Schema::drop('iassets');
    }
}
