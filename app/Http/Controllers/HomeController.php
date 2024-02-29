<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function home(){

        $categories = Category::all();

        return Inertia::render('Dashboard', [
            'categories' => $categories
        ]);

    }
}
