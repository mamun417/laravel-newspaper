<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonthlyFolder extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'folder_id';
}
