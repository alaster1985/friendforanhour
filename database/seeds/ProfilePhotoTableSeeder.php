<?php

use App\ProfilePhoto;
use Illuminate\Database\Seeder;

class ProfilePhotoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pathphoto = 'profilepictures';
        $arr = ['fennec', 'hamster', 'hedgehog', 'meerkat', 'mole', 'shark'];

        foreach ($arr as $key => $value) {
            for ($i = 1; $i <= 4; $i++) {
                $photo = new ProfilePhoto();
                $photo->photo_path = $pathphoto . '/' . $value . '/' . $value . $i . '.jpg';
                $photo->profile_id = $key + 1;
                if ($i === 1) {
                    $photo->main_photo_marker = true;
                } else {
                    $photo->main_photo_marker = false;
                }
                $photo->save();
            }

        }
    }
}
