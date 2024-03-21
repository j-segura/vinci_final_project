<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\StoreRequest;
use App\Models\Category;
use App\Models\Project;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        try {

            $categories = Category::select('id', 'name')->get();
            $tags = Tag::select('id', 'name')->get();
            return Inertia::render('Project/Create', compact('tags', 'categories'));

        } catch (\Exception $ex) {

            $message = 'Error en el método' . __METHOD__ . ' / ' . $ex;
            Log::error($message);
            return false;

        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {

            $data = $request->validated();

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('projects', 'public');
                $data['image'] = asset('storage/' . $imagePath);
            }

            $project = new Project();

            $project->title = $data['name'];
            $project->description = $data['description'];
            $project->image = $data['image'];
            $project->likes = 0;
            $project->status = 1;
            $project->author_id = auth()->user()->id;

            $project->save();

            $data['categories'] = array_column($data['categories'], 'id');
            $data['tags'] = array_column($data['tags'], 'id');

            if ($data['categories']) {
                $project->categories()->attach($data['categories']);
            }

            if ($data['tags']) {
                $project->tags()->attach($data['tags']);
            }

            return redirect()->route('profile.manager')->with('success', 'Project created successfully.');

        } catch (\Exception $ex) {

            $message = 'Error en el método' . __METHOD__ . ' / ' . $ex;
            Log::error($message);
            return false;

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        try {

            $project = Project::with('tags:id,name', 'author:id,name', 'comments.author:id,name,perfil_photo')->where('id', $project->id)->first();
            $moreProjects = Project::where('author_id', $project->author_id)->take(4)->get();
            $authUser = auth()->user()->id;

            return Inertia::render('Project/Show', [
                'project' => $project,
                'moreProjects' => $moreProjects,
                'authUser' => $authUser,
            ]);

        } catch (\Exception $ex) {

            $message = 'Error en el método' . __METHOD__ . ' / ' . $ex;
            Log::error($message);
            return false;

        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {

        try {

            $project = Project::with('tags:id,name', 'categories:id,name')->where('id', $project->id)->first();
            $categories = Category::select('id', 'name')->get();
            $tags = Tag::select('id', 'name')->get();
            return Inertia::render('Project/Edit', [
                'project' => $project,
                'categories' => $categories,
                'tags' => $tags
            ]);

        } catch (\Exception $ex) {

            $message = 'Error en el método' . __METHOD__ . ' / ' . $ex;
            Log::error($message);
            return false;

        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Project $project)
    {
        try {

            $data = $request->validated();

            $project = $project = Project::with('tags')->where('id', $project->id)->first();

            if ($request->hasFile('image')) {
                // Delete old Image if exists
                if ($project->image) {
                    Storage::delete($project->image);
                }

                $imagePath = $request->file('image')->store('projects', 'public');
                $data['image'] = asset('storage/' . $imagePath);
            } else {
                $data['image'] = $project->image;
            }

            $project->title = $data['name'];
            $project->description = $data['description'];
            $project->image = $data['image'];

            $project->save();

            $data['categories'] = array_column($data['categories'], 'id');
            $data['tags'] = array_column($data['tags'], 'id');

            if ($data['categories']) {
                $project->categories()->detach($project->categories);
                $project->categories()->attach($data['categories']);
            }

            if ($data['tags']) {
                $project->tags()->detach($project->tags);
                $project->tags()->attach($data['tags']);
            }

            return redirect()->route('profile.manager')->with('success', 'Project created successfully.');

        } catch (\Exception $ex) {

            $message = 'Error en el método' . __METHOD__ . ' / ' . $ex;
            Log::error($message);
            return false;

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        try {

            $project->delete();
            return redirect()->route('profile.manager')->with('success', 'Project deleted successfully.');

        } catch (\Exception $ex) {

            $message = 'Error en el método' . __METHOD__ . ' / ' . $ex;
            Log::error($message);
            return false;

        }
    }
}
