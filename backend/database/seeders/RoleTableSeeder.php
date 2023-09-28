<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'Admin';
        $role->description = 'Admin has full power to this system';
        $role->save();

        $role = new Role();
        $role->name = 'Manager';
        $role->description = 'Manager can do order related activities';
        $role->save();

        $role = new Role();
        $role->name = 'Viewer';
        $role->description = 'Viewer can see the reports only';
        $role->save();

        $role = new Role();
        $role->name = 'Customer';
        $role->description = 'Customer profile';
        $role->save();

        $role = new Role();
        $role->name = 'Dealer';
        $role->description = 'Dealer profile';
        $role->save();
    }
}
