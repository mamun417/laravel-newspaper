<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnAuthor extends Model
{
    protected $connection = 'mysqlen';
    protected $table = 'authors';
    protected $primaryKey = 'author_id';
}
