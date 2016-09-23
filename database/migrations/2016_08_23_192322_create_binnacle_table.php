<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBinnacleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('binnacle', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_acount', 100);
            $table->ipAddress('myip')->comment('dirección ip del visitante');
            $table->dateTime('date_end');
            $table->integer('log_types')->comment('tipo de identificador de los logs');
            $table->longText('logs')->comment('comentario de los logs');
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
        Schema::drop('binnacle');
    }
}
