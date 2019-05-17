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
            'сделаю массаж' => ['сделаю расслабляющий массаж ', 2],
            'хочу массаж' => ['хочу расслабляющий массаж ', 1],
            'угощу пивом' => ['угощу пивасиком в баре ', 2],
            'угощусь пивом' => ['угощусь пивасиком в баре ', 1],
            'сделаю маник' => ['сделаю маникюр ', 2],
            'хочу маник' => ['хочу маникюр ', 1],
            'схожу в магаз' => ['схожу в магазин за продуктами ', 2],
            'нужен курьер' => ['нужен курьер сходить в магазин за продуктами ', 2],
        ];

        foreach ($service_lists as $key => $value) {
            for ($i = 1; $i <= 6; $i++) {
                $service_list = new ServiceList();
                $service_list->service_name = $key . $i;
                $service_list->service_description = $value[0] . $i;
                $service_list->price = rand(0, 11) * 150;
                $service_list->service_type_id = $value[1];
                $service_list->save();
            }
        }
    }
}
