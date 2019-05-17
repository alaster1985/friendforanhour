<?php

use App\Profile;
use Illuminate\Database\Seeder;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $peoples = [
          ['Спиридон', 'Лисицин', '1999-12-01', 1, '88005553535', 1, false, false, null, true, false],
          ['Гертруда', 'Хомякова', '1999-12-02', 2, '88005553536', 2, false, false, null, true, false],
          ['Берттрамфай', 'Йожькекъ', '1999-12-03', 1, '88005553537', 3, false, false, null, true, false],
          ['Карамболла', 'Суррикатинова', '1999-12-04', 2, '88005553538', 4, false, false, null, true, false],
          ['Серафим', 'Кротцкийн', '1999-12-05', 1, '88005553539', 5, false, false, null, true, false],
          ['Ибрагимина', 'Акуловница', '1999-12-06', 2, '88005553530', 6, false, false, null, true, false],
        ];

        foreach ($peoples as $human) {
            $profile = new Profile();
            $profile->first_name = $human[0];
            $profile->second_name = $human[1];
            $profile->date_of_birth = $human[2];
            $profile->about = 'Я, ' . $human[0] . ' ' . $human[1] . ', ' . 'родился ' . $human[2] . '. Тут может быть ваша реклама. Звоните по номеру: ' . $human[4] . '';
            $profile->gender_id = $human[3];
            $profile->phone = $human[4];
            $profile->address_id = $human[5];
            $profile->is_deleted = $human[6];
            $profile->is_banned = $human[7];
            $profile->ban_finish_time = $human[8];
            $profile->sms_checked = $human[9];
            $profile->is_locked = $human[10];
            $profile->save();
        }
    }
}
