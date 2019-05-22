<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
         $this->call(GendersTableSeeder::class);
         $this->call(CountriesTableSeeder::class);
         $this->call(CitiesTableSeeder::class);
         $this->call(ProfileAddressesTableSeeder::class);
         $this->call(ServiceTypesTableSeeder::class);
//         $this->call(ServiceListsTableSeeder::class);
         $this->call(ProfilesTableSeeder::class);
         $this->call(ProfilePhotoTableSeeder::class);
//         $this->call(ProfileServiceListsTableSeeder::class);
        $this->call(ServiceListsTableSeeder::class);
        $this->call(RegularUsersTableSeeder::class);
    }
}
