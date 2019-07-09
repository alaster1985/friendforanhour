<?php

use App\ArticleCategory;
use Illuminate\Database\Seeder;

class ArticleCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'dating' => 'Знакомства',
            'services' => 'Услуги',
            'earn' => 'Заработать за час',
            'relax' => 'Отдохнуть',
        ];

        foreach ($categories as $key => $value) {
            $category = new ArticleCategory();
            $category->category_name = $key;
            $category->display_name = $value;
            $category->save();
        }
    }
}
