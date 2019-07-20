<?php

use App\TicketStatus;
use Illuminate\Database\Seeder;

class TicketStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = ['Отправленно', 'Принято к обработке', 'На рассмотрении', 'Обработано', 'Закрыто'];

        foreach ($statuses as $value) {
            $type = new TicketStatus();
            $type->status = $value;
            $type->save();
        }
    }
}
