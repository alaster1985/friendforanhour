<?php

use App\Gender;
use Illuminate\Database\Seeder;

class GendersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genders = ['женский' => 'female','мужской' => 'male'];

        foreach ($genders as $key => $val) {
            $gender = new Gender();
            $gender->gender_rus = $key;
            $gender->gender = $val;
            $gender->save();
        }
    }
}
