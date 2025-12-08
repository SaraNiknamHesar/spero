<?php

namespace App\Http\Controllers\Admin;
use App\Services\AlertService;
use App\Traits\FileUploadTrait;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ProfileController extends Controller
{
    use FileUploadTrait;
    function index(){
        return view('admin.profile.index');
    }
    function profileUpdate(Request $request): RedirectResponse{
         $request->validate([
            'name' => ['required','string','max:50'],
            'email' => ['required','email','unique:users,email,'.auth('admin')->user()->id],
            'avatar' => ['required','image','max:2048'],
            //
        ]); 
        $user = auth('admin')->user();
        if ($request->hasFile('avatar')) {
          $filepath=$this->uploadFile($request->file('avatar'),$user->avatar);
        $filepath ? $user->avatar = $filepath: null;
        }
        $user->name = $request->input('name');
        $user->email = $request->input('email');    
        $user->save();
        AlertService::updated();
        return redirect()->back();
    }
}