<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
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
        DB::table('regions')->truncate();

        // then seed
        DB::table('regions')->insert([
            [
                'id' => 1,
                'name' => json_encode([
                    'en' => 'Yangon',
                    'mm' => 'ရန်ကုန်',
                ]),
                'description' => json_encode([]),
            ],
            [
                'id' => 2,
                'name' => json_encode([
                    'en' => 'Mandalay',
                    'mm' => 'မန္တလေး',
                ]),
                'description' => json_encode([]),
            ],
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
