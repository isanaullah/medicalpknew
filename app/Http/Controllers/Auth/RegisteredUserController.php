<?php

namespace App\Http\Controllers\Auth;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
  /**
   * Display the registration view.
   *
   * @return \Illuminate\View\View
   */
  public function create()
  {
    return view('auth.register');
  }

  /**
   * Handle an incoming registration request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\RedirectResponse
   *
   * @throws \Illuminate\Validation\ValidationException
   */
  public function store(Request $request)
{
    // Get student role
    $userRole = Role::where('slug', '=', 'student')->first();

    // Validate request
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email',
        'password' => [
            'required',
            'confirmed',
            Rules\Password::defaults()
        ],
        'about' => 'nullable|string|max:500',
        'profile_photo' => 'nullable|image|max:2048',
        'fb' => 'nullable|url',
        'insta' => 'nullable|url',
        'twitter' => 'nullable|url',
        'linkden' => 'nullable|url',
    ]);

    // Upload profile photo
    if ($request->hasFile('profile_photo')) {

        $loc = '/public/user_profile_photos';

        $fileData = $request->file('profile_photo');

        $fileNameToStore = $this->uploadImage($fileData, $loc);

    } else {

        $fileNameToStore = 'default.png';
    }
    // Create user
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'profile_photo' => $fileNameToStore,
        'about' => $request->about,
        'fb' => $request->fb,
        'insta' => $request->insta,
        'twitter' => $request->twitter,
        'linkden' => $request->linkden,
        'status' => 1,
    ]);

    // Attach student role
    $user->attachRole($userRole);

    // Fire registered event
    event(new Registered($user));

    // Login user
    Auth::login($user);

    // Redirect to student dashboard
    return redirect(RouteServiceProvider::HOME);
}
  public function uploadImage($fileData, $loc)
  {
    // Get file name with extension
    $fileNameWithExt = $fileData->getClientOriginalName();
    // Get just file name
    $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
    // Get just extension
    $fileExtension = $fileData->extension();
    // File name to store
    $fileNameToStore = time() . '.' . $fileExtension;
    // Finally Upload Image
    $fileData->storeAs($loc, $fileNameToStore);

    return $fileNameToStore;
  }
}
