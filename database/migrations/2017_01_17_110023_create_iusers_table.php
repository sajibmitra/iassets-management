<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iusers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();;
            $table->string('department');
            $table->string('section');
            $table->string('designation');
            $table->string('contact_no');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('role');
            $table->rememberToken();
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('iusers')->insert(
            array(
                'name' => 'ICT Store',
                'department' => '0',
                'section' => 'ICT Cell',
                'designation' => '',
                'contact_no' => '01710283239',
                'email' => 'admin-bar@bb.org.bd',
                'role' => 'admin'
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('iusers');
    }
}