<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function home(){

        try {

            $categories = Category::all();

            $projects = Project::with('author:id,name,perfil_photo')->orderBy('created_at', 'desc')->paginate(15);

            return Inertia::render('Dashboard', [
                'categories' => $categories,
                'projects' => $projects,
            ]);

        } catch (\Exception $ex) {

            $message = 'Error en el método' . __METHOD__ . ' / ' . $ex;
            Log::error($message);
            return false;

        }

    }

    public function category(Category $category)
    {
        try {

            $category = Category::with('projects', 'projects.author:id,name,perfil_photo')->where('id', $category->id)->first();

            return Inertia::render('Filter', [
                'category' => $category,
            ]);

        } catch (\Exception $ex) {

            $message = 'Error en el método' . __METHOD__ . ' / ' . $ex;
            Log::error($message);
            return false;

        }
    }
}
