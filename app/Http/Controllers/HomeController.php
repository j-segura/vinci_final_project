<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function home(){

        $categories = Category::all();

        $projects = Project::with('author:id,name,perfil_photo')->orderBy('created_at', 'desc')->paginate(15);

        return Inertia::render('Dashboard', [
            'categories' => $categories,
            'projects' => $projects,
        ]);

    }
}
