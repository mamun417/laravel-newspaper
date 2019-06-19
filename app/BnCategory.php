<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BnCategory extends Model
{
    protected $connection = 'mysql';
    protected $table = 'bn_categories';
    protected $primaryKey = 'cat_id';

    public function subcategory(){
        return $this->hasMany('App\BnSubcategory', 'cat_id', 'cat_id')->with('content');
    }

    public function contents(){
        return $this->hasMany('App\BnContent', 'cat_id', 'cat_id')->with('category', 'subcategory')->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc');
    }
}
