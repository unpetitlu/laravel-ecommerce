<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = "image";

    public $timestamps = false;

    public function tasks()
    {
      return $this->belongsToMany('App\Task');
    }
}
