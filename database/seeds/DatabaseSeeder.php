<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\City::class, 30)->create();
        factory(\App\Company::class, 30)->create();
        factory(\App\Job::class, 30)->create();
        factory(\App\User::class, 1000)->create();
        factory(\App\User::class)->create([
            'name' => 'admin',
            'email' => 'admin@admin.admin',
            'password' => bcrypt('adminadmin'),
            'remember_token' => str_random(10),
            'role' => 1,
        ]);
    }
}
