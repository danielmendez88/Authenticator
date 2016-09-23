<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //creamos un arreglo
        $users = [
        	[
        		'name' => 'Daniel',
                'last_name' => 'Méndez cruz',
        		'email'=> 'lammer54@live.com.mx',
        		'password' => Hash::make('123456')
        	],
            [
                'name' => 'Mario',
                'last_name' => 'Hernandez Pérez',
                'email'=> 'mario.hernandez@cimat.mx',
                'password' => Hash::make('12345')
            ],
            [
                'name' => 'Juan',
                'last_name' => 'Macias Anaya',
                'email' => 'juan.macias@cimat.mx',
                'type' => 'admin',
                'password' => Hash::make('12345678')
            ]
        ];

        foreach ($users as $user) {
        	# code...
        	\App\User::create($user);
        }
    }
}
