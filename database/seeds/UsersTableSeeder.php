<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Create default User admin
         */
        factory(\App\User::class)
        	->times(1)
        	->create([
                'email'	=>	'admin@admin.com',
            	'name'	=>	'Sergio Gualberto Cruz Espinoza',
            	'password'	=>	bcrypt('password')
            ]);

        factory(\App\User::class)
            ->times(100)
            ->create();
    }
}
