<?php

use App\ServiceList;
use Illuminate\Database\Seeder;

class ServiceListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $service_lists = [
            'сделаю массаж' => ['сделаю расслабляющий массаж ', 2, true],
            'хочу массаж' => ['хочу расслабляющий массаж ', 1, true],
            'угощу пивом' => ['угощу пивасиком в баре ', 2, true],
            'угощусь пивом' => ['угощусь пивасиком в баре ', 1, true],
            'сделаю маник' => ['сделаю маникюр ', 2, false],
            'хочу маник' => ['хочу маникюр ', 1, false],
            'схожу в магаз' => ['схожу в магазин за продуктами ', 2, false],
            'нужен курьер' => ['нужен курьер сходить в магазин за продуктами ', 1, false],
        ];

        foreach ($service_lists as $key => $value) {
            for ($i = 1; $i <= 6; $i++) {
                $service_list = new ServiceList();
                $service_list->service_name = $key . $i;
                $service_list->service_description = $value[0] . $i;
                $service_list->price = rand(0, 11) * 150;
                $service_list->service_type_id = $value[1];

                $service_list->profile_id = $i;
                $service_list->main_service_marker = $value[2];

                $service_list->save();
            }
        }
    }
}
