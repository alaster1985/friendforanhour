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
            'images/news/{87834031-376F-AD8E-A24A-1DAA7B57DC5C}.jpg',
        ];

        for ($i = 0; $i <= 5; $i++) {
            for ($j = 1; $j <=4; $j++) {
                $article = new Article();
                $article->title = '#' . $j . '-' . $i . '. ' . $articles[0];
                $article->content = '#' . $j . '-' . $i . '. ' . $articles[1];
                $article->photo = $articles[2];
                $article->category_id = $j;
                $article->save();
            }
        }
    }
}
