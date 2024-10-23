<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder
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
        DB::table('areas')->truncate();

        $areas = [
            [
                'id' => 1,
                'name' => json_encode([
                    'en' => 'Ahlone',
                    'mm' => 'အလုံ',
                ]),
                'region_id' => 1,
            ],
            [
                'id' => 2,
                'name' => json_encode([
                    'en' => 'Bahan',
                    'mm' => 'ဗဟန်း',
                ]),
                'region_id' => 1,
            ],
            [
                'id' => 3,
                'name' => json_encode([
                    'en' => 'Botahtaung',
                    'mm' => 'ဗိုလ်တစ်ထောင်',
                ]),
                'region_id' => 1,
            ],
            [
                'id' => 4,
                'name' => json_encode([
                    'en' => 'Dagon',
                    'mm' => 'ဒဂုံ',
                ]),
                'region_id' => 1,
            ],
            [
                'id' => 5,
                'name' => json_encode([
                    'en' => 'East Dagon',
                    'mm' => 'ဒဂုံမြို့သစ်အရှေ့ပိုင်း',
                ]),
                'region_id' => 1,
            ],
            [
                'id' => 6,
                'name' => json_encode([
                    'en' => 'North Dagon',
                    'mm' => 'ဒဂုံမြို့သစ်မြောက်ပိုင်း',
                ]),
                'region_id' => 1,
            ],
            [
                'id' => 7,
                'name' => json_encode([
                    'en' => 'Dagon Seikkan',
                    'mm' => 'ဒဂုံဆိပ်ကမ်း',
                ]),
                'region_id' => 1,
            ],
            [
                'id' => 8,
                'name' => json_encode([
                    'en' => 'South Dagon',
                    'mm' => 'ဒဂုံမြို့သစ်တောင်ပိုင်း',
                ]),
                'region_id' => 1,
            ],
            [
                'id' => 9,
                'name' => json_encode([
                    'en' => 'Dawbon',
                    'mm' => 'ဒေါပုံ',
                ]),
                'region_id' => 1,
            ],
            [
                'id' => 10,
                'name' => json_encode([
                    'en' => 'Hlaing',
                    'mm' => 'လှိုင်',
                ]),
                'region_id' => 1,
            ],
            [
                'id' => 11,
                'name' => json_encode([
                    'en' => 'Hlaingthaya',
                    'mm' => 'လှိုင်သာယာ',
                ]),
                'region_id' => 1,
            ],
            [
                'id' => 12,
                'name' => json_encode([
                    'en' => 'Insein',
                    'mm' => 'အင်းစိန်',
                ]),
                'region_id' => 1,
            ],
            [
                'id' => 13,
                'name' => json_encode([
                    'en' => 'Kamayut',
                    'mm' => 'ကမာရွတ်',
                ]),
                'region_id' => 1,
            ],
            [
                'id' => 14,
                'name' => json_encode([
                    'en' => 'Kyauktada',
                    'mm' => 'ကျောက်တံတား',
                ]),
                'region_id' => 1,
            ],
            [
                'id' => 15,
                'name' => json_encode([
                    'en' => 'Kyimyindaing',
                    'mm' => 'ကြည့်မြင်တိုင်',
                ]),
                'region_id' => 1,
            ],
            [
                'id' => 16,
                'name' => json_encode([
                    'en' => 'Lanmadaw',
                    'mm' => 'လမ်းမတော်',
                ]),
                'region_id' => 1,
            ],
            [
                'id' => 17,
                'name' => json_encode([
                    'en' => 'Latha',
                    'mm' => 'လသာ',
                ]),
                'region_id' => 1,
            ],
            [
                'id' => 18,
                'name' => json_encode([
                    'en' => 'Mayangone',
                    'mm' => 'မရမ်းကုန်း',
                ]),
                'region_id' => 1,
            ],
            [
                'id' => 19,
                'name' => json_encode([
                    'en' => 'Mingala Taungnyunt',
                    'mm' => 'မင်္ဂလာတောင်ညွန့်',
                ]),
                'region_id' => 1,
            ],
            [
                'id' => 20,
                'name' => json_encode([
                    'en' => 'Mingaladon',
                    'mm' => 'မင်္ဂလာဒုံ',
                ]),
                'region_id' => 1,
            ],
            [
                'id' => 21,
                'name' => json_encode([
                    'en' => 'North Okkalapa',
                    'mm' => 'မြောက်ဥက္ကလာပ',
                ]),
                'region_id' => 1,
            ],
            [
                'id' => 22,
                'name' => json_encode([
                    'en' => 'Pabedan',
                    'mm' => 'ပန်းဘဲတန်း',
                ]),
                'region_id' => 1,
            ],
            [
                'id' => 23,
                'name' => json_encode([
                    'en' => 'Pazundaung',
                    'mm' => 'ပုဇွန်တောင်',
                ]),
                'region_id' => 1,
            ],
            [
                'id' => 24,
                'name' => json_encode([
                    'en' => 'Sanchaung',
                    'mm' => 'စမ်းချောင်း',
                ]),
                'region_id' => 1,
            ],
            [
                'id' => 25,
                'name' => json_encode([
                    'en' => 'Seikkan',
                    'mm' => 'ဆိပ်ကမ်း',
                ]),
                'region_id' => 1,
            ],
            [
                'id' => 26,
                'name' => json_encode([
                    'en' => 'Shwepyitha',
                    'mm' => 'ရွှေပြည်သာ',
                ]),
                'region_id' => 1,
            ],
            [
                'id' => 27,
                'name' => json_encode([
                    'en' => 'South Okkalapa',
                    'mm' => 'တောင်ဥက္ကလာပ',
                ]),
                'region_id' => 1,
            ],
            [
                'id' => 28,
                'name' => json_encode([
                    'en' => 'Tamwe',
                    'mm' => 'တာမွေ',
                ]),
                'region_id' => 1,
            ],
            [
                'id' => 29,
                'name' => json_encode([
                    'en' => 'Thaketa',
                    'mm' => 'သာကေတ',
                ]),
                'region_id' => 1,
            ],
            [
                'id' => 30,
                'name' => json_encode([
                    'en' => 'Thanlyin',
                    'mm' => 'သန်လျင်',
                ]),
                'region_id' => 1,
            ],
            [
                'id' => 31,
                'name' => json_encode([
                    'en' => 'Thingangyun',
                    'mm' => 'သင်္ကန်းကျွန်း',
                ]),
                'region_id' => 1,
            ],
            [
                'id' => 32,
                'name' => json_encode([
                    'en' => 'Yankin',
                    'mm' => 'ရန်ကင်း',
                ]),
                'region_id' => 1,
            ],
            [
                'id' => 33,
                'name' => json_encode([
                    'en' => 'Aungmyaythazan Township',
                    'mm' => 'အောင်မြေသာစံ',
                ]),
                'region_id' => 2,
            ],
            [
                'id' => 34,
                'name' => json_encode([
                    'en' => 'Chanayethazan Township',
                    'mm' => 'ချမ်းအေးသာစံ ',
                ]),
                'region_id' => 2,
            ],
            [
                'id' => 35,
                'name' => json_encode([
                    'en' => 'Chanmyathazi Township',
                    'mm' => 'ချမ်းမြသာစည်',
                ]),
                'region_id' => 2,
            ],
            [
                'id' => 36,
                'name' => json_encode([
                    'en' => 'Maha Aungmye Township',
                    'mm' => 'မဟာအောင်မြေ',
                ]),
                'region_id' => 2,
            ],
            [
                'id' => 37,
                'name' => json_encode([
                    'en' => 'Pyigyidagun Township',
                    'mm' => 'ပြည်ကြီးတံခွန်',
                ]),
                'region_id' => 2,
            ],
            [
                'id' => 38,
                'name' => json_encode([
                    'en' => 'Amarapura Township',
                    'mm' => 'အမရပူရ',
                ]),
                'region_id' => 2,
            ],

        ];

        // then seed
        DB::table('areas')->insert($areas);

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
