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
        return $this->belongsToMany('App\Models\Category');
    }

    public function tags()  {
        return $this->belongsToMany('App\Models\Tag');
    }

}
