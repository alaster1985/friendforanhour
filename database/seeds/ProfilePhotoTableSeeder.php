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
        $arr = ['1', '2', '3', '4', '5', '6'];

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
                $photo->is_deleted = false;
                $photo->save();
            }

        }
    }
}
