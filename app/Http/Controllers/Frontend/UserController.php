<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index()
    {
        return view('frontend.users.profile');
    }

    public function updateUserDetails(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string'],
            'personal_tax_code' => ['required', 'string','max:19'],
            'billing_email' => ['email', 'string', 'max: 149'],
            'phone' => ['required', 'string','max:19'],
            'pin_code' => ['required', 'string','max:19'],
            'address' => ['required', 'string', 'max:499'],
            'profile_image' => ['nullable', 'mimes:jpg,jpeg,png', 'max:499'],
            'country' => ['required', 'string','max:19'],
        ]);

        $user = User::findOrFail(Auth::user()->id);
        $user ->update([
            'name' => $request->username
        ]);

        $uploadPath = "";
        $filename = "";

        if ($request->hasFile('profile_image') && $request->file('profile_image')->isValid()) {

            $uploadPath = "uploads/faces/";
            $file = $request->file('profile_image');
            $ext = $file->getClientOriginalExtension();

            // Verifique se a extensão é permitida (jpg, jpeg, png)
            if (in_array($ext, ['jpg', 'jpeg', 'png'])) {
                $filename = 'face' . $user->id . '.' . $ext;
                $file->move($uploadPath, $filename);
            } else {
                return redirect()->route('category.create')->with('error', "The image extension must be in 'jpg', 'jpeg' or 'png' format.");
            }
        }
        try {
            $user->userDetail()->updateOrCreate(
                [
                    'user_id' => $user->id,
                ],
                [
                    'personal_tax_code' => $request->personal_tax_code,
                    'billing_email' => $request->billing_email,
                    'phone' => $request->phone,
                    'pin_code' => $request->pin_code,
                    'country' => $request->country,
                    'address' => $request->address,
                    'profile_image' => $uploadPath.$filename,
                ]
            );
        } catch (\Exception $e) {
            // Exibe a mensagem de erro
            dd($e->getMessage());
        }


        return redirect()->back()->with('message', 'User profile updated');
    }

    public function passwordCreate()
    {
        return view('frontend.users.change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required','string','min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $currentPasswordStatus = Hash::check($request->password, auth()->user()->password);

        if(!$currentPasswordStatus){

            User::findOrFail(Auth::user()->id)->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()->back()->with('message','Password Updated Successfully');

        }else{

            return redirect()->back()->with('message','Current Password does not match with Old Password');
        }
    }
}

