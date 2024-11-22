<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory;use SoftDeletes;


    public function client (){
        return $this->hasOne('App\Models\Client', 'id', 'client_id');
    }

    public function user (){
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    public function items (){
        return $this->hasMany('App\Models\Invoice_item', 'invoice_id', 'id');
    }
}
