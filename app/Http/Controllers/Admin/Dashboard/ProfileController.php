<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        return view('admin.pages.dashboard.user.profile.index', compact('user'));
    }
    // Show the edit form
    public function edit()
    {
        $user = Auth::user();
        return view('admin.pages.dashboard.user.profile.update', compact('user'));
    }

    // Handle profile update
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'image' => 'nullable|image',
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:6',
        ]);

        // basic fields
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;

        // password optional
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // image via move() (simple)
        if ($request->hasFile('image')) {
            $dir = public_path('assets/admin/images/code/user');
            if (!is_dir($dir))
                mkdir($dir, 0755, true);

            $file = $request->file('image');
            $ext = strtolower($file->getClientOriginalExtension() ?: 'jpg');
            $filename = uniqid('user_') . '.' . $ext;
            $file->move($dir, $filename);

            // old image delete (optional, simple)
            if (!empty($user->image) && file_exists(public_path($user->image))) {
                @unlink(public_path($user->image));
            }

            $user->image = 'assets/admin/images/code/user/' . $filename;
        }

        $user->save();

        return redirect()->route('profile.index')->with('success', 'Profile updated ✅');
    }

}
