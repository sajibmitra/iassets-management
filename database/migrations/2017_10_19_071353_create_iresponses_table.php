<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIresponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iresponses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('iuser_dtl')->unsigned();
            $table->integer('iasset_dtl')->unsigned();
            $table->string('report_via');
            $table->string('problem_dtl');
            $table->timestamp('requested_at')->nullable();
            $table->timestamp('finished_at')->nullable();
            $table->string('problem_status');
            $table->string('respond_by');
            $table->string('action_taken');
            $table->string('remarks');

            $table->timestamps();
            $table->foreign('iuser_dtl')->references('id')->on('iusers')->onDelete('cascade');
            $table->foreign('iasset_dtl')->references('id')->on('iassets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('iresponses');
    }
}
