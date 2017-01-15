<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeyConstraintsMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('iassets', function(Blueprint $table){
            $table->integer('user_id')->unsigned();
            $table->integer('vendor_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('iassets', function(Blueprint $table){
            $table->dropForeign('iassets_user_id_foreign');
            $table->dropForeign('iassets_vendor_id_foreign');
        });
    }
}
