<?php

namespace Database\Seeders;

use App\Enums\GeneralStatusEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
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
        DB::table('services')->truncate();

        // then seed
        DB::table('services')->insert([
            [
                'id' => 1,
                'name' => json_encode([
                    'en' => '3 Hours One Time Maid service',
                    'mm' => '၃ နာရီ အချိန်ပိုင်းအကူဝန်ဆောင်မှု',
                ]),
                'description' => json_encode([
                    'en' => '<p>3 Hours One Time Maid service is the best service that helps - </p><p>&emsp;- people who do not want a regular full-time maid at home<br>&emsp;- people need help with household chores with excellence and safety within a certain period of time.</p><b>What can we do best?</b><p>&emsp;✓ Iroing<br>&emsp;✓ Brooming<br>&emsp;✓ Mopping<br>&emsp;✓ Cleaning<br>&emsp;✓ Relocating necessary objects at your house<br>&emsp;✓ Collecting garbages<br>&emsp;✓ Washing dishes<br>&emsp;✓ Cleaning restrooms<br>&emsp;✓ Helping with charity work<br>&emsp;✓ Other necessary household chores at your request</p><b>Benefits of using our services</b><p>Our part-time maid service is company-directed service, so; </p><p>&emsp;✓ we are morally reliable<br>&emsp;✓ we carefully train our maid and they are excellent at taking care of household chores<br>&emsp;✓ they will serve you at their expense, thus you do not need to support food or a place to stay</p>',
                    'mm' => '<p>အချိန်ပိုင်းအကူဝန်ဆောင်မှုဆိုတာ - </p><p>&emsp;- အိမ်မှာ အိမ်အကူ သီးသန့်မထားချင်တဲ့သူတွေ<br>&emsp;- အိမ်မှုကိစ္စနှင့် အိမ်သန့်ရှင်းရေးလုပ်ဖို့ အကူအညီလိုသူတွေအတွက်</p><p>မြန်အံ့က အချိန်ပိုင်းသန့်ရှင်းရေးဝန်ထမ်းများနဲ့ သင်ရဲ့ အိမ်မှုကိစ္စအဝဝကို အချိန်ပိုင်းဖြင့် ကူညီပေးသော ဝန်ဆောင်မှုဖြစ်ပါတယ်။</p><b>မြန်အံ့က အချိန်ပိုင်းသန့်ရှင်းရေးဝန်ထမ်းတွေက</b><p>&emsp;✓ မီးပူတိုက်မယ်ပေးမယ်<br>&emsp;✓ တံမြက်စည်းလှည်းပေးမယ်<br>&emsp;✓ ကြမ်းတိုက်ပေးမယ်<br>&emsp;✓ သန့်ရှင်းရေးလုပ်ပေးမယ်<br>&emsp;✓ ပစ္စည်းတွေ ရွေ့ပေးမယ်၊ နေရာချပေးမယ်<br>&emsp;✓ အမှိုက်သိမ်းပေးမယ်<br>&emsp;✓ ပန်းကန်ဆေးပေးမယ်<br>&emsp;✓ သန့်စင်ခန်းကို သန့်ရှင်းရေးလုပ်ပေးမယ်<br>&emsp;✓ အလှူအိမ်တွေမှာ ဝိုင်းကူပေးမယ်<br>&emsp;✓ သင်လိုအပ်တဲ့ အိမ်တွင်းဝေယျာဝစ္စတွေကို စနစ်တကျလုပ်ဆောင်ပေးမယ်</p>',
                ]),
                'category_id' => 1,
                'price' => 30000,
                'currency' => 'Ks',
                'image' => 'https://gitlab.com/aungkyawminn/static-files/-/raw/main/services/maid-service-3-hours.jpg',
                'status' => GeneralStatusEnum::ACTIVE->value,
            ],
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
