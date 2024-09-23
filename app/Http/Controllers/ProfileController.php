<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Service\UserProfileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use File;
use App\Models\User;
use Intervention\Image\Laravel\Facades\Image;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('cms.profile.edit', [
            'user' => $request->user(),
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
        \Session::flash('notification', ['level' => 'success', 'message' => 'Profile has been updated']);
        return Redirect::route('profile.edit');
    }

    public function updatePhoto(Request $request)
    {
        $user = User::findOrFail(\Auth::user()->id);
        $validator = Validator::make($request->all(), [
            'photo' => 'mimes:jpeg,png',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'photo')
                ->withInput();
        }

        if ($request->hasFile('photo')) {
            $userProfileService = new UserProfileService();
            $data['profile_picture'] = $userProfileService->saveImageProfile($request->file('photo'), $user->name);
            if ('' !== $user->profile_picture) {
                $userProfileService->deleteImageProfile($user->profile_picture);
            }
        }

        $user->update($data);
        \Session::flash('notification', ['level' => 'success', 'message' => 'Profile picture has been updated']);
        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        if ($user->profile_picture !== '') {
            $userProfileService = new UserProfileService();
            $userProfileService->deleteImageProfile($user->profile_picture);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
