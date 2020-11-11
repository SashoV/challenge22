<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    // protected $dateFormat = 'd/m/Y H:i:s';

    public function thread()
    {
        return $this->belongsTo('App\Thread');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
