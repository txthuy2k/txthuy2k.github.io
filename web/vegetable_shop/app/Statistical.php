<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statistical extends Model
{
    protected $table = 'statistical';

    protected $primaryKey = 'id_statistic';
    protected $guarded = [];
}
