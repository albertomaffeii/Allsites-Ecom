<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Http\Requests\SettingFormRequest;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::first();
        return view('admin.setting.index', compact('settings'));
    }

    public function update(SettingFormRequest $request)
    {

        $data = $request->validated();

        $settings = Setting::first();

        $destination = $settings->logotipo;
        $settings->fill($data);
        $settings->save();
        $uploadPath = "uploads/settings/";

        if ($request->hasFile('logotipo')) {

            if (File::exists($destination)) {
                File::delete($destination);
            }

            $imageFile = $request->file('logotipo');
            $extention = $imageFile->getClientOriginalExtension();
            $filename = 'logo.' . $extention;
            $imageFile->move($uploadPath, $filename);
            $destination = 'uploads/settings/'.$filename;
            $settings = Setting::find(1);
            $settings->logotipo = $destination;
            $settings->save();
        }

        return redirect()->route('settings')->with('message', 'Settings updated successfully!');
    }
}
