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
        $pathPhoto = 'profilepictures';
        $arr = [
            1 => 'fennec',
            2 => 'hamster',
            3 => 'hedgehog',
            4 => 'meerkat',
            5 => 'mole',
            6 => 'shark',
        ];

        foreach ($arr as $key => $value) {
            for ($i = 1; $i <= 4; $i++) {
                $photo = new ProfilePhoto();
                $photo->photo_path = $pathPhoto . '/' . $key . '/' . $value . $i . '1.jpg';
                $photo->profile_id = $key;
                if ($i === 1) {
                    $photo->main_photo_marker = true;
                } else {
                    $photo->main_photo_marker = false;
                }
                $photo->is_deleted = false;
                $photo->save();
            }

        }
    }
}
