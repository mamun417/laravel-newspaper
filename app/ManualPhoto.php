<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManualPhoto extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'photo_id';
}
