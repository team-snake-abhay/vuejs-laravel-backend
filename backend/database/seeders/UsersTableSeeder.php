<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Branch;
use App\Models\Client;
use App\Models\Role;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $user = new User();
        $user->name = 'Admin';
        $user->username = 'admin';
        $user->email = "{$user->username}@test.com";
        $user->password = bcrypt('123456');
        $user->status = 1;
        $user->mobile_varified_at = \Carbon\Carbon::now();
        $user->url = '/admin/dashboard';
        $user->save();
        $user->roles()->attach(Role::where('name', $user->name)->first());

        $user = new User();
        $user->name = 'Customer';
        $user->username = 'customer';
        $user->email = 'customer@test.com';
        $user->password = bcrypt('123456');
        $user->status = 1;
        $user->url = '/customer/dashboard';
        $user->mobile_varified_at = \Carbon\Carbon::now();
        $user->save();
        $user->roles()->attach(Role::where('name', 'Customer')->first());

    }
}
