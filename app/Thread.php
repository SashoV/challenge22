<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use League\CommonMark\Extension\Attributes\Node\Attributes;
use phpDocumentor\Reflection\Types\This;

class Thread extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category() 
    {
        return $this->belongsTo('App\Category');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    protected $attributes =
    [
        'is_approved' => 0
    ];
}
