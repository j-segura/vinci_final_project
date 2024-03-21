<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';
    protected $primaryKey = 'id';
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $guarded = [];

    public function categories()  {
        return $this->belongsToMany('App\Models\Category', 'projects_categories');
    }

    public function tags()  {
        return $this->belongsToMany('App\Models\Tag', 'projects_tags');
    }

    public function author() {
        return $this->belongsTo('App\Models\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }


}
