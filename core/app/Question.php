<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    protected $fillable = [
        'question','question_cat','question_image','first_option','second_option','third_option','fourth_option','fifth_option','answer'
    ];
    /*public function subcategory()
    {
        return $this->belongsTo('App\SubCategory');
    }*/
}
