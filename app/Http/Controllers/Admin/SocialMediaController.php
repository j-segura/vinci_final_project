<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SocialMedia\StoreRequest;
use App\Http\Requests\Admin\SocialMedia\UpdateRequest;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class SocialMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $socialMedias = SocialMedia::orderBy('created_at', 'desc')->paginate(10);
            return Inertia::render('Admin/SocialMedias/Index', compact('socialMedias'));

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
        return Inertia::render('Admin/SocialMedias/Create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {

            $data = $request->validated();

            if ($request->hasFile('icon')) {
                $iconPath = $request->file('icon')->store('socialMedias', 'public');
                $data['icon'] = asset('storage/' . $iconPath);
            }

            SocialMedia::create($data);

            return redirect()->route('social-medias.index')->with('success', 'Social Media created successfully.');

        } catch (\Exception $ex) {

            $message = 'Error en el método' . __METHOD__ . ' / ' . $ex;
            Log::error($message);
            return false;

        }

    }

    public function edit(SocialMedia $socialMedia)
    {
        return Inertia::render('Admin/SocialMedias/Edit', compact('socialMedia'));
    }

    public function update(UpdateRequest $request, SocialMedia $socialMedia)
    {
        try {

            $data = $request->validated();

            if ($request->hasFile('icon')) {

                if ($socialMedia->icon) {
                    Storage::delete($socialMedia->icon);
                }

                $iconPath = $request->file('icon')->store('socialMedias', 'public');
                $data['icon'] = asset('storage/' . $iconPath);

            } else {
                $data['icon'] = $socialMedia->icon;
            }

            $socialMedia->update($data);
            return redirect()->route('social-medias.index')->with('success', 'Social Media updated successfully.');

        } catch (\Exception $ex) {

            $message = 'Error en el método' . __METHOD__ . ' / ' . $ex;
            Log::error($message);
            return false;

        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SocialMedia $socialMedia)
    {
        try {

            $socialMedia->delete();
            return redirect()->route('social-medias.index')->with('success', 'Social Media deleted successfully.');

        } catch (\Exception $ex) {

            $message = 'Error en el método' . __METHOD__ . ' / ' . $ex;
            Log::error($message);
            return false;

        }

    }
}
