<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MisUser extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'user_id';
}
