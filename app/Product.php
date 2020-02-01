<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
        'amount','phone_number',
    ];


    public function transaction(){
        
        return $this->belongsTo('App\Transaction');
    }

}
