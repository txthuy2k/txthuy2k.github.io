<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = "cart";

    protected $primaryKey = 'cart_id';
    protected $guarded = [];
}
