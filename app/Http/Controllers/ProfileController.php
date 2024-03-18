<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\ReferenceStore;
use App\Http\Requests\UpdateProfileManagerRequest;
use App\Models\Project;
use App\Models\Reference;
use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function manager() {

        $projects = Project::where('author_id', auth()->user()->id)->get();
        $projectsCount = count($projects);
        $references = Reference::with('author:id,name,perfil_photo')->where('user_id', auth()->user()->id)->get();
        $user = auth()->user();

        return Inertia::render('Profile/Manager', [
            'projects' => $projects,
            'user' => $user,
            'projectsCount' => $projectsCount,
            'references' => $references,
            'localType' => 'M',
        ]);

    }

    public function show(User $user) {

        $projects = Project::where('author_id', $user->id)->get();
        $projectsCount = count($projects);
        $userAuth = User::find(auth()->user()->id);
        $references = Reference::with('author:id,name,perfil_photo')->where('user_id', $user->id)->get();

        return Inertia::render('Profile/Manager', [
            'projects' => $projects,
            'user' => $user,
            'userAuth' => $userAuth,
            'projectsCount' => $projectsCount,
            'references' => $references,
            'localType' => 'S',
        ]);

    }

    public function updateManager(UpdateProfileManagerRequest $request)
    {
        try {

            $data = $request->validated();

            $user = User::find(auth()->user()->id);

            // validamos si ya existe un curriculum de lo contrario la actualiza
            if ($request->hasFile('curriculum')) {

                if ($user->curriculum) {
                    Storage::delete($user->curriculum);
                }

                $curriculumPath = $request->file('curriculum')->store('curriculum', 'public');
                $data['curriculum'] = asset('storage/' . $curriculumPath);

            } else {

                $data['curriculum'] = $user->curriculum;

            }

            // validamos si ya existe una foto de perfil de lo contrario la actualiza
            if ($request->hasFile('perfil_photo')) {

                if ($user->perfil_photo) {
                    Storage::delete($user->perfil_photo);
                }
                $perfilPhotoPath = $request->file('perfil_photo')->store('profilePhotos', 'public');
                $data['perfil_photo'] = asset('storage/' . $perfilPhotoPath);

            } else {

                $data['perfil_photo'] = $user->perfil_photo;

            }

            // validamos si ya existe una foto de perfil de lo contrario la actualiza
            if ($request->hasFile('about_image')) {

                if ($user->about_image) {
                    Storage::delete($user->about_image);
                }

                $aboutImagePath = $request->file('about_image')->store('aboutUserImage', 'public');
                $data['about_image'] = asset('storage/' . $aboutImagePath);

            } else {

                $data['about_image'] = $user->about_image;

            }

            $user->about = isset($data['about']) ? $data['about'] : $user->about;
            $user->about_image = $data['about_image'];
            $user->curriculum = $data['curriculum'];
            $user->perfil_photo = $data['perfil_photo'];

            $user->update();

            return redirect()->route('profile.manager')->with('success', 'Profile updated successfully.');

        } catch (\Exception $ex) {

            $message = 'Error en el método' . __METHOD__ . ' / ' . $ex;
            Log::error($message);
            return false;

        }

    }

    public function referenceStore(ReferenceStore $request, User $user) {

        try {

            $data = $request->validated();

            $reference = new Reference();

            $reference->content = $data['comment'];
            $reference->user_id = $user->id;
            $reference->author_id = auth()->user()->id;

            $reference->save();

            return redirect()->route('profile.show', $user)->with('success', 'Reference added with successfully.');

        } catch (\Exception $ex) {

            $message = 'Error en el método' . __METHOD__ . ' / ' . $ex;
            Log::error($message);
            return false;

        }

    }

}
