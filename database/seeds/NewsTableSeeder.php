<?php

use App\News;
use Illuminate\Database\Seeder;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newsS = [
            'Всемирный дефицит женщин: ученые бьют тревогу  (опрос)',
            'По оценкам ООН, в мире на 100 женщин приходится 101,8 мужчин. Количество мужчин с 1960 ежегодно увеличивается. А недавно исследователи американской Национальной академии назвали шокирующую цифру — на планете не хватает 23 миллиона женщин.',
            'images/news/{87834031-376F-AD8E-A24A-1DAA7B57DC5C}.jpg',
        ];

        for ($i = 0; $i <= 5; $i++) {
            $news = new News();
            $news->title = '#' . $i . '. ' . $newsS[0];
            $news->content = '#' . $i . '. ' . $newsS[1];
            $news->photo = $newsS[2];
            $news->save();
        }
    }
}
