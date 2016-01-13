<?php

namespace App\Http\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

  protected $table = 'user';


    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;


    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}