<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManualDocument extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'doc_id';

}
