<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        $this->call(RoleTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(SubscriptionTableSeeder::class);
        // $this->call(AccHeadTableSeeder::class);
        // $this->call(CategoryTableSeeder::class);
        // $this->call(ColorTableSeeder::class);
        
        // $path = 'app/Imports/torayvino.sql';
        // DB::unprepared(file_get_contents($path));
        // $this->command->info('Temp tables seeded!');

        // $path = 'app/Imports/countries.sql';
        // DB::unprepared(file_get_contents($path));
        // $this->command->info('Country table seeded!');
        
        // $path = 'app/Imports/divisions.sql';
        // DB::unprepared(file_get_contents($path));
        // $this->command->info('Division table seeded!');

        // $path = 'app/Imports/districts.sql';
        // DB::unprepared(file_get_contents($path));
        // $this->command->info('Districts table seeded!');

        // $path = 'app/Imports/upazilas.sql';
        // DB::unprepared(file_get_contents($path));
        // $this->command->info('Upazillas table seeded!');
    }
}
