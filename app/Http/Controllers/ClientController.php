<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Countries;
use Auth;
use App\User;
use App\Category;
use App\UserSkill;
use App\Skill;

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
    public function my_skills() {
        $userSkills = UserSkill::
                    join('skills','skills.id','=','user_skills.skill_id')                    
                    ->where('user_skills.user_id','=',Auth::user()->id)
                    ->get();
                
        $allSkills = Skill::where('active',1)->get();
        return view('clients.my_skills', compact('allSkills','userSkills'));
    }
    public function skillsUpdate(Request $request) {
        $skills_ids =  $request->input('skills_id');  
        
        foreach ($skills_ids as $skillID) {
            $ifExists = UserSkill::where('user_id', Auth::user()->id)->where('skill_id',$skillID)->get();
            if(count($ifExists) < 1){
                $userSkill =new UserSkill();
                $userSkill->user_id = Auth::user()->id;
                $userSkill->skill_id = $skillID;
                $userSkill->save();
            }             
        }
       
    }
    public function my_skills_delete(Request $request) {
        $skill_id = $request->input('item_id');
        $item = UserSkill::where('user_id',Auth::user()->id)->where('skill_id',$skill_id)->first();
        $item->delete();
    }
}
