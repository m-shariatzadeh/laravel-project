<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $directory = 'images/';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = ['title','body'];

//    protected $hidden = ['active'];

    public function photos()
    {
        return $this->morphMany('App\Models\Photo','photo');
    }

    public function tags()
    {
        return $this->morphToMany('App\Models\Tag','taggable');
    }

    //Accessor
    public function getTitleAttribute($value)
    {
        return ucfirst($value);
    }

    //Mutator
    public function setTitleAttribute($value)
    {
        return $this->attributes['title'] = ucfirst($value);
    }

    public function getImageAttribute($value)
    {
        return $this->directory . $value;
    }
}
