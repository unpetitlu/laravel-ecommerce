<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = "task";

    public $timestamps = false;


    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function category()
    {
      return $this->belongsToMany('App\Category');
    }

    public function images()
    {
      return $this->belongsToMany('App\Image');
    }
}
