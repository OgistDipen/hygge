<?php

use Illuminate\Database\Seeder;
use App\User;;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->delete();

        User::create([
            'name' => 'Monkey D. Luffy',
            'email' => 'luffy@gmail.com',
            'password' => '$2y$10$5LV0fCWEk1d8bMNN5ciJHeuZZaeku8GEptnA.nc7XEvrg7LfawHqS', //password
        ]);

        User::create([
            'name' => 'Akagami no Shanks',
            'email' => 'shanks@gmail.com',
            'password' => '$2y$10$5LV0fCWEk1d8bMNN5ciJHeuZZaeku8GEptnA.nc7XEvrg7LfawHqS', //password
        ]);

        User::create([
            'name' => 'Portgas D. Ace',
            'email' => 'ace@gmail.com',
            'password' => '$2y$10$5LV0fCWEk1d8bMNN5ciJHeuZZaeku8GEptnA.nc7XEvrg7LfawHqS', //password
        ]);

        User::create([
            'name' => 'Bertrand Russell',
            'email' => 'russell@gmail.com',
            'password' => '$2y$10$5LV0fCWEk1d8bMNN5ciJHeuZZaeku8GEptnA.nc7XEvrg7LfawHqS', //password
        ]);

        User::create([
            'name' => 'Immanuel Kant',
            'email' => 'kant@gmail.com',
            'password' => '$2y$10$5LV0fCWEk1d8bMNN5ciJHeuZZaeku8GEptnA.nc7XEvrg7LfawHqS', //password
        ]);
    }
}
