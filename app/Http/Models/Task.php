<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

  protected $table = 'task';


    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}