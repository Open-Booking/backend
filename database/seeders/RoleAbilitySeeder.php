<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleAbilitySeeder extends Seeder
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
        DB::table('role_ability')->truncate();

        // then seed
        DB::table('role_ability')->insert([
            ['id' => 1, 'role_id' => 1, 'ability_id' => 1],
            ['id' => 2, 'role_id' => 1, 'ability_id' => 2],
            ['id' => 3, 'role_id' => 1, 'ability_id' => 3],
            ['id' => 4, 'role_id' => 1, 'ability_id' => 4],
            ['id' => 5, 'role_id' => 1, 'ability_id' => 5],
            ['id' => 6, 'role_id' => 1, 'ability_id' => 6],
            ['id' => 7, 'role_id' => 1, 'ability_id' => 7],
            ['id' => 8, 'role_id' => 1, 'ability_id' => 8],
            ['id' => 9, 'role_id' => 1, 'ability_id' => 9],
            ['id' => 10, 'role_id' => 1, 'ability_id' => 10],
            ['id' => 11, 'role_id' => 1, 'ability_id' => 11],
            ['id' => 12, 'role_id' => 1, 'ability_id' => 12],
            ['id' => 13, 'role_id' => 1, 'ability_id' => 13],
            ['id' => 14, 'role_id' => 1, 'ability_id' => 14],
            ['id' => 15, 'role_id' => 1, 'ability_id' => 15],
            ['id' => 16, 'role_id' => 1, 'ability_id' => 16],
            ['id' => 17, 'role_id' => 1, 'ability_id' => 17],
            ['id' => 18, 'role_id' => 1, 'ability_id' => 18],
            ['id' => 19, 'role_id' => 1, 'ability_id' => 19],
            ['id' => 20, 'role_id' => 1, 'ability_id' => 20],
            ['id' => 21, 'role_id' => 1, 'ability_id' => 21],
            ['id' => 22, 'role_id' => 1, 'ability_id' => 22],
            ['id' => 23, 'role_id' => 1, 'ability_id' => 23],
            ['id' => 24, 'role_id' => 1, 'ability_id' => 24],
            ['id' => 25, 'role_id' => 1, 'ability_id' => 25],
            ['id' => 26, 'role_id' => 1, 'ability_id' => 26],
            ['id' => 27, 'role_id' => 1, 'ability_id' => 27],
            ['id' => 28, 'role_id' => 1, 'ability_id' => 28],
            ['id' => 29, 'role_id' => 1, 'ability_id' => 29],
            ['id' => 30, 'role_id' => 1, 'ability_id' => 30],
            ['id' => 31, 'role_id' => 1, 'ability_id' => 31],
            ['id' => 32, 'role_id' => 1, 'ability_id' => 32],
            ['id' => 33, 'role_id' => 1, 'ability_id' => 33],
            ['id' => 34, 'role_id' => 1, 'ability_id' => 34],
            ['id' => 35, 'role_id' => 1, 'ability_id' => 35],
            ['id' => 36, 'role_id' => 1, 'ability_id' => 36],
            ['id' => 37, 'role_id' => 1, 'ability_id' => 37],
            ['id' => 38, 'role_id' => 1, 'ability_id' => 38],
            ['id' => 39, 'role_id' => 1, 'ability_id' => 39],
            ['id' => 40, 'role_id' => 1, 'ability_id' => 40],
            ['id' => 41, 'role_id' => 1, 'ability_id' => 41],
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
