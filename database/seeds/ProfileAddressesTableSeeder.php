<?php

use App\ProfileAddress;
use Illuminate\Database\Seeder;

class ProfileAddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $addresses = [
            'Адмирала Ушакова ул., 6' => [48.802045,44.619724],
            'им Дзержинского ул., 49' => [48.806003,44.587780],
            'им маршала Воронова ул., 14' => [48.646012,44.410983],
            'им Грибанова ул., 13' => [48.662986,44.410534],
            'им Солнечникова ул., 3' => [48.661177,44.419427],
            'Костромской пер., 100' => [48.723082,44.495703],
        ];

        foreach ($addresses as $key => $value) {
            $addresse = new ProfileAddress();
            $addresse->address = $key;
            $addresse->latitude = $value[0];
            $addresse->longitude = $value[1];
            $addresse->city_id = 1;
        }
    }
}
