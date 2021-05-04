<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;

    protected $table = 'categories';

    protected $fillable = [
        'name','description'
    ];
    public function subcategory()
    {
        return $this->hasMany('App\SubCategory');
    }
}
