<?php

use App\ProfileServiceList;
use Illuminate\Database\Seeder;

class ProfileServiceListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 48; $i++) {
            $serviceList = new ProfileServiceList();
            $serviceList->service_list_id = $i;
            $serviceList->profile_id = ($i-1) % 6 + 1;
            $i <= 24 ? $a = true : $a = false;
            $serviceList->main_service_mark = $a;
            $serviceList->save();
        }
    }
}
