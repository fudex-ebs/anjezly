<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Countries;
use Auth;
use App\User;
use App\Category;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
class ClientController extends Controller
{
    public function personal_info() {
        $countries = Countries::all();
        $categories = Category::where('active',1)->get();
        return view('clients.personal_info', compact('countries','categories'));
    }
    public function personal_info_update(Request $request) {
        $user  = Auth::user();
        $user->update($request->all());        
         
        $user->gender = $request->gender;  
        $user->renter = $request->renter;  
        $user->update(); 
         
        return back()->with('success','لقد تم تحديث بياناتك بنجاح');
    }
    public function personal_info_uploadImg(Request $request) {         
        $this->validate($request, [          
           'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]); 
        
        $img_name = time().'.'.$request->file('img')->getClientOriginalExtension();
        $request->file('img')->move(base_path().'/public/uploads/',$img_name);   
        
        $user = Auth::user();
        $user->img = $img_name;
        $user->update();
        
        return $img_name;    

    }
}
