<?php

use App\TransactionName;
use Illuminate\Database\Seeder;

class TransactionNamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transactionNames = [
            ['1 month', 'Subscription for 1 month', 100],
        ];

        foreach ($transactionNames as $value) {
            $type = new TransactionName();
            $type->transaction_name = $value[0];
            $type->description = $value[1];
            $type->price = $value[2]*100;
            $type->save();
        }
    }
}
