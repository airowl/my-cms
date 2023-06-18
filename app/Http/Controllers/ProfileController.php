<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function show(Request $request): Response
    {

        var_dump('ffooo');
        exit;
        //return Inertia::render('Profile/Edit', [
        //    'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
        //    'status' => session('status'),
        //]);
    }

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
    public function update(ProfileUpdateRequest $request)
    {
        $user = User::find($request->user()->id);
        $currentRequest = (object)$request->validated();
        $user->firstName = $currentRequest->firstName;
        $user->middleName = $currentRequest->middleName;
        $user->lastName = $currentRequest->lastName;
        $user->email = $currentRequest->email;

        $file = $request->avatar;
        if (isset($file)) {
            $nameFile = $user->firstName . date('Yms') . Str::random(5) . '.' . $file->extension();
            $path = $file->storeAs(
                'public/avatars',
                $nameFile
            );
            if ($path) {
                $user->avatar = $path;
            }
        }

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $success = $user->save();

        return to_route('profile');
    }

    /**
     * Update the user's profile information.
     */
    public function updateAvatar(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile');
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
}
