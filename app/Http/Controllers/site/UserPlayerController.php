<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Http\Requests\user\StoreUserRequest;
use App\Http\Requests\user\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserPlayerController extends Controller
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
    public function create(): View
    {
        return view('site.pages.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $validated = $request->safe()->only(['username', 'email', 'password']);

        $userCreated = User::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);

        $playerRole = Role::where('name', 'Player')->first();

        $userCreated->roles()->attach($playerRole);

        return redirect()->route('login');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $user = auth()->user();
        return view('site.pages.profile', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(): View
    {
        $user = auth()->user();
        return view('site.pages.edit-profile', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $validated = $request->safe()->only(['username', 'email', 'password']);

        $user->update([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => $validated['password'] ? Hash::make($validated['password']) : $user->password
        ]);

        return redirect()->route('profile')
            ->with('success', 'Profile updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->update([
            'is_active' => false
        ]);

        auth()->logout();

        return redirect()->route('home')
            ->with('success', 'User deactivated successfully');
    }
}
