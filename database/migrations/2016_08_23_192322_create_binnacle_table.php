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
            $table->integer('user_id')->unsigned();
            $table->ipAddress('myip')->comment('dirección ip del visitante');
            $table->time('date_ini');
            $table->time('date_end');
            $table->longText('logs')->commet('log para obtener informacion');
            $table->timestamps();

            //restricciones de llave foranea
            $table->foreign('user_id')
                  ->references('id')->on('users')
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
        Schema::drop('binnacle');
    }
}
