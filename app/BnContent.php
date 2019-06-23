<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BnContent extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'content_id';

    public function category(){
        return $this->belongsTo('App\BnCategory', 'cat_id', 'cat_id')
            ->select('cat_id', 'cat_name', 'cat_name_bn', 'cat_slug')
            ->where('cat_type', 1);
    }

    public function subcategory(){
        return $this->belongsTo('App\BnSubcategory', 'subcat_id', 'subcat_id')
            ->select('subcat_id', 'subcat_name', 'subcat_name_bn', 'subcat_slug');
    }

    public function specialCategory(){
        return $this->belongsTo('App\BnCategory', 'special_cat_id', 'cat_id')
            ->select('cat_id', 'cat_name', 'cat_name_bn', 'cat_slug')
            ->where('cat_type', 2);
    }

    public function comments(){
        return $this->hasMany('App\BnComment', 'content_id', 'content_id')->where('approval', 2);
    }

    public function misUser(){
        return $this->belongsTo('App\MisUser', 'updated_by', 'user_id')->where('deletable', 1);
    }

    public function misUserName(){
        return $this->belongsTo('App\MisUser', 'uploader_id', 'user_id')->where('deletable', 1);
    }
}
