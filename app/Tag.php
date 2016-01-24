<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = "tag";

    public $timestamps = false;

    public function tasks()
    {
      return $this->belongsToMany('App\Task')->withPivot('poid');
    }
}
