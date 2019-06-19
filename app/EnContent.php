<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnContent extends Model
{
    protected $connection = 'mysqlen';
    protected $table = 'en_contents';
    protected $primaryKey = 'content_id';

    public function category(){
        return $this->belongsTo('App\EnCategory', 'cat_id', 'cat_id')
            ->select('cat_id', 'cat_name', 'cat_name', 'cat_slug')
            ->where('cat_type', 1);
    }

    public function subcategory(){
        return $this->belongsTo('App\EnSubcategory', 'subcat_id', 'subcat_id')
            ->select('subcat_id', 'subcat_name', 'subcat_name', 'subcat_slug');
    }

    public function specialCategory(){
        return $this->belongsTo('App\EnCategory', 'special_cat_id', 'cat_id')
            ->select('cat_id', 'cat_name', 'cat_name', 'cat_slug')
            ->where('cat_type', 2);
    }

    public function comments(){
        return $this->hasMany('App\EnComment', 'content_id', 'content_id')->where('approval', 2);
    }
}
