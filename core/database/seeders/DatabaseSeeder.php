<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();

        \App\Modules\Users\User::create([
            'name' => 'karim abdelaah',
            'type' => 'admin',
            'mobile_number' => '01091811793',
            'password' => 'password',
            'is_admin' => 1,

        ]);

    }
}
