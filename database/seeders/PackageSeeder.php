<?php

namespace Database\Seeders;

use App\Enums\GeneralStatusEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackageSeeder extends Seeder
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
        DB::table('packages')->truncate();

        // then seed
        DB::table('packages')->insert([
            [
                'id' => 1,
                'name' => json_encode([
                    'en' => '10 times VIP Package',
                    'mm' => '10 ကြိမ် VIP Package',
                ]),
                'description' => json_encode([
                    'en' => '<b>Advantages of 10 times VIP package Maid service</b> <p> (Fairest Price VIP Package)<br> &emsp;✓ Get One Time free<br> &emsp;✓ Selectly send the well-performed maid<br> &emsp;✓ You do not have to order again and again<br> </p> <b>Detail</b> <p> &emsp;- Duration : 3 hours per time<br> &emsp;- Default Maid : 3 persons (Alternately)<br> &emsp;- Service times : 10 times + 1 time free<br> &emsp;- Term : 1 year',
                    'mm' => '<b>10 ကြိမ် VIP Package အချိန်ပိုင်းအကူဝန်ဆောင်မှု အားသာချက်များ</b> <p> &emsp;✓ ဝန်ဆောင်မှုအကြိမ်ရေ တစ်ကြိမ် အခမဲ့ ရရှိခြင်း<br> &emsp;✓ လက်ရွေးစင်သန့်ရှင်းရေးဝန်ထမ်းကို ရွေးချယ်လွှတ်ပေးခြင်း<br> &emsp;✓ အော်ဒါ ခဏခဏ တင်စရာမလိုခြင်း<br> </p> <b>အသေးစိတ်</b> <p> &emsp;- အချိန် : တစ်ကြိမ်လျှင် 3 နာရီ<br> &emsp;- ပင်တိုင်သန့်ရှင်းရေးဝန်ထမ်း : 3 ယောက် (အလှည့်ကျ)<br> &emsp;- ဝန်ဆောင်မှုအကြိမ်ရေ : 10 ကြိမ် + 1 ကြိမ် အခမဲ့<br> &emsp;- သက်တမ်း : 1 နှစ်',
                ]),
                'price' => 300000,
                'currency' => 'Ks',
                'image' => 'https://gitlab.com/aungkyawminn/static-files/-/raw/main/packages/10-vip.jpg',
                'status' => GeneralStatusEnum::ACTIVE->value,
            ],
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
