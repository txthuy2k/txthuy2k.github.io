<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = "order_detail";

    protected $primaryKey = 'order_detail_id';
    protected $guarded = [];
}
