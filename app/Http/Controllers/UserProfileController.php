<?php

namespace App\Http\Controllers;

use App\Image;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;

class UserProfileController extends Controller
{
    public function index()
    {
        return view('front.user.profile');
    }

    public function editProfile()
    {
        $images = Image::where('user_id', Auth::id())->get();
        return view('front.user.edit_profile', compact('images'));
    }

    public function updateProfile(Request $request)
    {
        $user = User::where('id', Auth::id())->first();
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
        ]);
        if ($request->photo) {
            $photoName = time() . '.' . $request->photo->getClientOriginalExtension();
            $photo = $request->photo->move(public_path('upload/user'), $photoName);
        }
        else{
            $photoName = Auth::user()->photo;
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'postcode' => $request->postcode,
            'business_type' => $request->business_type,
            'business_description' => $request->business_description,
            'no_of_employee' => $request->no_of_employee,
            'website_url' => $request->website_url,
            'photo' => $photoName
        ]);
        $images = $request->images;
        if ($images){
            foreach ($images as $key=>$image){
                $imgName = $key.time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('upload/user/images'), $imgName);
                Image::create([
                    'user_id' => Auth::id(),
                    'name' => $imgName
                ]);
            }
        }

        return redirect()->back()->with('success', 'Updated Successfully.');
    }

    public function deleteImage($id)
    {
        $image = Image::where('id', $id)->first();
        $image_path = public_path('upload/user/images/'. $image->name);
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        Image::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Delete Successfully.');
    }
}
