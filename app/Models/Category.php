<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $dates = ['created_at', 'updated_at'];

    protected $guarded = [];

    public function projects()  {
        return $this->belongsToMany('App\Models\Project', 'projects_categories');
    }
}
