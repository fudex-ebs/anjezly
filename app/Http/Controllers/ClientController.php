<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Countries;
use Auth;
use App\User;

class ClientController extends Controller
{
    public function personal_info() {
        $countries = Countries::all();
        return view('clients.personal_info', compact('countries'));
    }
    public function personal_info_update(Request $request) {
        $user  = Auth::user();
        $user->update($request->all());
        $user->gender = $request->gender;
        $user->update(); 
        return back()->with('success','لقد تم تحديث بياناتك بنجاح');
    }
}
