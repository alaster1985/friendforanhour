<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionName extends Model
{
    protected $table = 'transaction_names';
    protected $fillable = ['transaction_name', 'description', 'price'];

    public function transaction()
    {
        return $this->hasMany('App\Transaction');
    }
}
