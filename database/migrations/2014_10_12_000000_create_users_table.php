<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration; #es una clase que se extiende a migraciones

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations. ejecutar migraciones
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('type', ['miembro', 'admin'])->default('miembro');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations. Si se está reiniciando las migraciones borrará la tabla usuario para volver a ejecutar la migración
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
