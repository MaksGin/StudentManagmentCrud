<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class RoleTableSeeder extends Seeder
{
    public function run()
    {
        // Seed roles table with dummy data
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'User']);
        // Add more roles as needed...
    }
}
