<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $categories = Category::orderBy('created_at', 'desc')->paginate(15);
            return Inertia::render('Admin/Categories/Index', compact('categories'));

        } catch (\Exception $ex) {

            $message = 'Error en el método' . __METHOD__ . ' / ' . $ex;
            Log::error($message);
            return false;

        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Categories/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {

            $data = $request->validated();

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('categories', 'public');
                $data['image'] = asset('storage/' . $imagePath);
            }

            Category::create($data);

            return redirect()->route('categories.index')->with('success', 'Category created successfully.');

        } catch (\Exception $ex) {

            $message = 'Error en el método' . __METHOD__ . ' / ' . $ex;
            Log::error($message);
            return false;

        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return Inertia::render('Admin/Categories/Edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Category $category)
    {
        try {

            $data = $request->validated();

            if ($request->hasFile('image')) {
                // Delete old Image if exists
                if ($category->image) {
                    Storage::delete($category->image);
                }

                $imagePath = $request->file('image')->store('categories', 'public');
                $data['image'] = asset('storage/' . $imagePath);
            } else {
                $data['image'] = $category->image;
            }

            $category->update($data);
            return redirect()->route('categories.index')->with('success', 'Category updated successfully.');

        } catch (\Exception $ex) {

            $message = 'Error en el método' . __METHOD__ . ' / ' . $ex;
            Log::error($message);
            return false;

        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {

            $category->delete();
            return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');

        } catch (\Exception $ex) {

            $message = 'Error en el método' . __METHOD__ . ' / ' . $ex;
            Log::error($message);
            return false;

        }

    }
}
