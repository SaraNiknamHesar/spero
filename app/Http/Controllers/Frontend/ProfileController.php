<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\AlertService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class ProfileController extends Controller
{
    public function index()
    {
        return view('frontend.dashboard.account.index');
    }
    public function profileUpdate(Request $request):RedirectResponse
    {
        
        $request->validate([
            'name' => ['required','string','max:50'],
            'email' => ['required','email','unique:users,email,'.auth('web')->user()->id],
            //
        ]); 

        $user = auth('web')->user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();
        AlertService::updated();
        return redirect()->back();
      
    }
    public function passwordUpdate(Request $request):RedirectResponse
    {
        $request->validate([
            'current_password' => ['required','string','current_password'],
            'password' => ['required','string','min:8','confirmed'],
            //
        ]); 

        $user = auth('web')->user();
        $user->password = bcrypt($request->password);
        $user->save();
        AlertService::updated();
        return redirect()->back(); 
    }
}