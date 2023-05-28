<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        $user = auth()->user(); 
        $formFields = $request->validate([
        'created_by'=>$user->id,
        'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
    ]);

    $image = new Image();

    // Check if an image was uploaded
    if ($request->hasFile('profile_image')) {
        $pic = $request->file('profile_image');
        $filename = uniqid() . '.' . $pic->getClientOriginalExtension();
        $path = $pic->storeAs('public/images', $filename);
        $path = str_replace('public/images/', '', $path);

        // Set the image path in the database
        $image->profile_image = $path;
    }

    $image->save();
    return redirect('/admin/profile')->with('message', 'image added successfully');
    }
}
