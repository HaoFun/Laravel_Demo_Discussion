<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussions extends Model
{
    protected $fillable = ['title','body','user_id','last_user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comments::class,'discussion_id','id');
    }
}
