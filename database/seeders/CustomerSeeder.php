<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        // empty all data
        DB::table('customers')->truncate();

        // then seed
        DB::table('customers')->insert([
            ['id' => 1, 'full_name' => 'Demo Customer', 'mobile_number' => '095454549',
                'attributes' => json_encode([
                    'nearest_landmark' => 'shopping center',
                    'nearest_bus_stop' => 'sanpya zay',
                ]),
                'area_id' => 1,
                'status' => 'Active'],
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
