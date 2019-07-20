<?php

use App\ServiceType;
use Illuminate\Database\Seeder;

class ServiceTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['спонсор', 'друг'];

        foreach ($types as $value) {
            $type = new ServiceType();
            $type->service_type_name = $value;
            $type->save();
        }
    }
}
