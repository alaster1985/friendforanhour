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
        $genders = ['female','male'];

        foreach ($genders as $val) {
            $gender = new Gender();
            $gender->gender = $val;
            $gender->save();
        }
    }
}
