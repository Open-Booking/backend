<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AbilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        // empty data first
        DB::table('abilities')->truncate();

        // then seed
        DB::table('abilities')->insert([
            ['id' => 1, 'action' => 'index', 'subject' => 'Home'],
            ['id' => 2, 'action' => 'index', 'subject' => 'Role'],
            ['id' => 3, 'action' => 'create', 'subject' => 'Role'],
            ['id' => 4, 'action' => 'read', 'subject' => 'Role'],
            ['id' => 5, 'action' => 'update', 'subject' => 'Role'],
            ['id' => 6, 'action' => 'delete', 'subject' => 'Role'],
            ['id' => 7, 'action' => 'index', 'subject' => 'User'],
            ['id' => 8, 'action' => 'create', 'subject' => 'User'],
            ['id' => 9, 'action' => 'read', 'subject' => 'User'],
            ['id' => 10, 'action' => 'update', 'subject' => 'User'],
            ['id' => 11, 'action' => 'delete', 'subject' => 'User'],
            ['id' => 12, 'action' => 'index', 'subject' => 'Category'],
            ['id' => 13, 'action' => 'create', 'subject' => 'Category'],
            ['id' => 14, 'action' => 'read', 'subject' => 'Category'],
            ['id' => 15, 'action' => 'update', 'subject' => 'Category'],
            ['id' => 16, 'action' => 'delete', 'subject' => 'Category'],
            ['id' => 17, 'action' => 'index', 'subject' => 'Service'],
            ['id' => 18, 'action' => 'create', 'subject' => 'Service'],
            ['id' => 19, 'action' => 'read', 'subject' => 'Service'],
            ['id' => 20, 'action' => 'update', 'subject' => 'Service'],
            ['id' => 21, 'action' => 'delete', 'subject' => 'Service'],
            ['id' => 22, 'action' => 'index', 'subject' => 'Package'],
            ['id' => 23, 'action' => 'create', 'subject' => 'Package'],
            ['id' => 24, 'action' => 'read', 'subject' => 'Package'],
            ['id' => 25, 'action' => 'update', 'subject' => 'Package'],
            ['id' => 26, 'action' => 'delete', 'subject' => 'Package'],
            ['id' => 27, 'action' => 'index', 'subject' => 'Customer'],
            ['id' => 28, 'action' => 'create', 'subject' => 'Customer'],
            ['id' => 29, 'action' => 'read', 'subject' => 'Customer'],
            ['id' => 30, 'action' => 'update', 'subject' => 'Customer'],
            ['id' => 31, 'action' => 'delete', 'subject' => 'Customer'],
            ['id' => 32, 'action' => 'index', 'subject' => 'Booking'],
            ['id' => 33, 'action' => 'create', 'subject' => 'Booking'],
            ['id' => 34, 'action' => 'read', 'subject' => 'Booking'],
            ['id' => 35, 'action' => 'update', 'subject' => 'Booking'],
            ['id' => 36, 'action' => 'delete', 'subject' => 'Booking'],
            ['id' => 37, 'action' => 'index', 'subject' => 'PackageSale'],
            ['id' => 38, 'action' => 'create', 'subject' => 'PackageSale'],
            ['id' => 39, 'action' => 'read', 'subject' => 'PackageSale'],
            ['id' => 40, 'action' => 'update', 'subject' => 'PackageSale'],
            ['id' => 41, 'action' => 'delete', 'subject' => 'PackageSale'],
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
