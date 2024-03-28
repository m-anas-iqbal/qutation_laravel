<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfileSettingsController extends Controller
{
    public function profile()
    {
        $data['user'] = Auth::user();

        return view('admin.settings.my-profile', $data);
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
        ]);
        
        Auth::user()->update([
            'password' => bcrypt($request->password)
        ]);

        return back()->with('success', ('Profile updated successfully'));
    }

    public function changePassword()
    {
        return view('admin.settings.change-password');
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();
        if (!\Hash::check($request->old_password, $user->password)) {
            return back()->with('warning', ('Old password is incorrect'));
        }

        $user->update([
            'password' => bcrypt($request->password)
        ]);

        return back()->with('success', ('Password changed successfully'));
    }
}
