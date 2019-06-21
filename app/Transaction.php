<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['profile_id', 'transaction_name_id'];

    public function transactionName()
    {
        return $this->belongsTo('App\TransactionName');
    }

    public function profile()
    {
        return $this->belongsTo('App\Profile');
    }

    public function getMoneyFormat()
    {
        setlocale(LC_MONETARY, 'ru_RU');
        return money_format('%i', $this->transactionName->price/100);
    }
}
