<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'profile_image' => ['nullable', 'image', 'max:2048'], // Max 2MB for profile image
            //'panel_color' => ['required', 'string', 'max:20'],
        ]);

        $user = User::findOrFail(Auth::user()->id);

        if ($request->email !== $user->email) {
            $request->validate([
                'email' => ['unique:users'],
            ]);
        }

        $user ->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        $uploadPath = "";
        $filename = "";

        if ($request->hasFile('profile_image') && $request->file('profile_image')->isValid()) {
            $uploadPath = "uploads/faces/";
            $profileImage = $request->file('profile_image');
            $ext = $profileImage->getClientOriginalExtension();

            if (in_array($ext, ['jpg', 'jpeg', 'png'])) {
                $filename = 'face' . $user->id . '.' . $ext;
                $profileImage->move($uploadPath, $filename);
            } else {
                return redirect()->route('category.create')->with('error', "The image extension must be in 'jpg', 'jpeg' or 'png' format.");
            }
        }

        try {
            $user->userDetail()->update(
                [
                    'user_id' => $user->id,
                    'panel_color' => $request->input('panel-color'),
                ]
            );

            if ($filename) {
                $user->userDetail()->update([
                    'profile_image' => $uploadPath . $filename,
                ]);
            }

            if ($request->filled('password')) {
                $user->update([
                    'password' => Hash::make($request->password)
                ]);
            }

        } catch (\Exception $e) {
            // Exibe a mensagem de erro
            dd($e->getMessage());
        }


        return redirect()->back()->with('message', 'User profile updated');
    }
}
