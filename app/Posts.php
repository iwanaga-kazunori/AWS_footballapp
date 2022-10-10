<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    //
    protected $guarded = array('id');

    public static $rules = array(
        'image_path' => ['file','mimes:jpeg,png,jpg,bmb'],
        'body' => 'required',
    );
}
