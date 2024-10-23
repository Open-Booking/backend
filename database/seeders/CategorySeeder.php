<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
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
        DB::table('categories')->truncate();

        // then seed
        DB::table('categories')->insert([
            [
                'id' => 1,
                'name' => json_encode([
                    'en' => 'Cleaning',
                    'mm' => 'သန့်ရှင်းရေး',
                ]),
                'image' => 'https://gitlab.com/aungkyawminn/static-files/-/raw/main/cleaning.svg',
                'status' => 'Active',
            ],
            [
                'id' => 2,
                'name' => json_encode([
                    'en' => 'Repair',
                    'mm' => 'ပြုပြင်ရေး',
                ]),
                'image' => 'https://gitlab.com/aungkyawminn/static-files/-/raw/main/repair.svg',
                'status' => 'Active',
            ],
            [
                'id' => 3,
                'name' => json_encode([
                    'en' => 'Pest Control',
                    'mm' => 'ပိုးမွှားရှင်း',
                ]),
                'image' => 'https://gitlab.com/aungkyawminn/static-files/-/raw/main/pest-control.svg',
                'status' => 'Active',
            ],
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
