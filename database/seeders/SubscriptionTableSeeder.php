<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subscription;
use Illuminate\Cache\RateLimiting\Unlimited;

class SubscriptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $obj = new Subscription();
        $obj->package_name = 'basic';
        $obj->product_code = '397317';
        $obj->email_credential = 1;
        $obj->max_story_length = 5;
        $obj->audio_length_max = 30;
        $obj->monthly_story_max = 30;
        $obj->story_per_day = 3;
        $obj->analytics = 'like+reactions';
        $obj->comment_under_story = false;
        $obj->chapter_organize = false;
        $obj->embedadable_player = false;
        $obj->password_protected = false;
        $obj->save();

        $obj = new Subscription();
        $obj->package_name = 'pro';
        $obj->product_code = '397320';
        $obj->email_credential = 1;
        $obj->max_story_length = 15;
        $obj->audio_length_max = 180;
        $obj->monthly_story_max = 30;
        $obj->story_per_day = 5;
        $obj->analytics = 'like+reactions';
        $obj->comment_under_story = true;
        $obj->chapter_organize = true;
        $obj->embedadable_player = false;
        $obj->password_protected = false;
        $obj->save();

        $obj = new Subscription();
        $obj->package_name = 'recurring';
        $obj->product_code = '397326';
        $obj->email_credential = 1;
        $obj->max_story_length = 20;
        $obj->audio_length_max = 300;
        $obj->monthly_story_max = 45;
        $obj->story_per_day = 0;
        $obj->analytics = 'like+reactions';
        $obj->comment_under_story = true;
        $obj->chapter_organize = true;
        $obj->embedadable_player = true;
        $obj->password_protected = true;
        $obj->save();


        $obj = new Subscription();
        $obj->package_name = 'whitelabel';
        $obj->product_code = '397324';
        $obj->email_credential = 0;
        $obj->max_story_length = 5;
        $obj->audio_length_max = 30;
        $obj->monthly_story_max = 30;
        $obj->story_per_day = 3;
        $obj->analytics = 'like+reactions';
        $obj->comment_under_story = true;
        $obj->chapter_organize = true;
        $obj->embedadable_player = true;
        $obj->password_protected = true;
        $obj->save();

        $obj = new Subscription();
        $obj->package_name = 'reseller';
        $obj->product_code = '397322';
        $obj->email_credential = 0;
        $obj->max_story_length = 3;
        $obj->audio_length_max = 30;
        $obj->monthly_story_max = 30;
        $obj->story_per_day = 5;
        $obj->analytics = 'like+reactions';
        $obj->comment_under_story = true;
        $obj->chapter_organize = true;
        $obj->embedadable_player = true;
        $obj->password_protected = true;
        $obj->save();

        $obj = new Subscription();
        $obj->package_name = 'ProPlus';
        $obj->product_code = '397319';
        $obj->email_credential = 0;
        $obj->max_story_length = 3;
        $obj->audio_length_max = 30;
        $obj->monthly_story_max = 30;
        $obj->story_per_day = 5;
        $obj->analytics = 'like+reactions';
        $obj->comment_under_story = true;
        $obj->chapter_organize = true;
        $obj->embedadable_player = true;
        $obj->password_protected = true;
        $obj->save();

        $obj = new Subscription();
        $obj->package_name = 'ProPlus';
        $obj->product_code = '397328';
        $obj->email_credential = 0;
        $obj->max_story_length = 3;
        $obj->audio_length_max = 30;
        $obj->monthly_story_max = 30;
        $obj->story_per_day = 5;
        $obj->analytics = 'like+reactions';
        $obj->comment_under_story = true;
        $obj->chapter_organize = true;
        $obj->embedadable_player = true;
        $obj->password_protected = true;
        $obj->save();

    }
}
