<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdsManagement extends Model
{
    protected $connection = 'mysql';
    protected $table = 'ads_management';

    protected $fillable = ['position', 'ads_code', 'start_date', 'end_date', 'status'];
}
