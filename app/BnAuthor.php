<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BnAuthor extends Model
{
    protected $connection = 'mysql';
    protected $table = 'authors';
    protected $primaryKey = 'author_id';
}
