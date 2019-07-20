<?php

use App\Article;
use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $articles = [
            'Всемирный дефицит женщин: ученые бьют тревогу  (опрос)',
            'По оценкам ООН, в мире на 100 женщин приходится 101,8 мужчин. Количество мужчин с 1960 ежегодно увеличивается. А недавно исследователи американской Национальной академии назвали шокирующую цифру — на планете не хватает 23 миллиона женщин.',
            'images/articles/{6F8067DE-2837-E8A1-85E0-0F98164C6F42}.jpg',
        ];

        $categories = [
            'dating',
            'services',
            'earn',
            'relax',
        ];

        for ($i = 0; $i <= 3; $i++) {
            foreach ($categories as $key => $ctg) {
                $article = new Article();
                $article->title = '#' . $ctg . '-' . $i . '. ' . $articles[0];
                $article->content = '#' . $ctg . '-' . $i . '. ' . $articles[1];
                $article->photo = $articles[2];
                $article->category_id = $key + 1;
                $article->save();
            }
        }
    }
}
