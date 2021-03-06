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
//        $peoples = [
//          ['Спиридон', 'Лисицин', '1999-12-01', 2, '88005553535', 1, false, false, null, true, false],
//          ['Гертруда', 'Хомякова', '1999-12-02', 1, '88005553536', 2, false, false, null, true, false],
//          ['Берттрамфай', 'Йожькекъ', '1999-12-03', 2, '88005553537', 3, false, false, null, true, false],
//          ['Карамболла', 'Суррикатинова', '1999-12-04', 1, '88005553538', 4, false, false, null, true, false],
//          ['Серафим', 'Кротцкийн', '1999-12-05', 2, '88005553539', 5, false, false, null, true, false],
//          ['Ибрагимина', 'Акуловница', '1999-12-06', 1, '88005553530', 6, false, false, null, true, false],
//        ];
        $peoples = [
          ['Эш', 'Уильямс', '1999-12-01', 2, '88005553535', 1, false, false, null, true, false],
          ['Анджелина', 'Джоли', '1999-12-02', 1, '88005553536', 2, false, false, null, true, false],
          ['Джек', 'Уоарабэи', '1999-12-03', 2, '88005553537', 3, false, false, null, true, false],
          ['Элен', 'Рипли', '1999-12-04', 1, '88005553538', 4, false, false, null, true, false],
          ['Элвис', 'Пресли', '1999-12-05', 2, '88005553539', 5, false, false, null, true, false],
          ['Памелла', 'Андерсон', '1999-12-06', 1, '88005553530', 6, false, false, null, true, false],
        ];

        foreach ($peoples as $human) {
            $profile = new Profile();
            $profile->first_name = $human[0];
            $profile->second_name = $human[1];
            $profile->date_of_birth = rand(1970, 2000) . '-' . rand(1, 12) . '-' . rand(1, 27);;
            $profile->about = 'Я, ' . $human[0] . ' ' . $human[1] . ', ' . 'родился ' . $human[2] . '. Тут может быть ваша реклама. Звоните по номеру: ' . $human[4] . '';
            $profile->gender_id = $human[3];
            $profile->height = rand(150,190);
            $profile->weight = rand(45,90);
            $profile->gender_id = $human[3];
            $profile->phone = $human[4];
            $profile->profile_address_id = $human[5];
            $profile->is_deleted = $human[6];
            $profile->is_banned = $human[7];
//            $profile->ban_finish_time = $human[8];
            $profile->subscription_end_date = strtotime("+30 days");
//            $profile->sms_checked = $human[9];
            $profile->is_locked = $human[10];
            $profile->save();
        }
    }
}
