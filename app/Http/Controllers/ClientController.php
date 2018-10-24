<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Countries;
use Auth;
use App\User;
use App\Category;
use App\UserSkill;
use App\Skill;
use App\UserPortofolio;

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
    public function portfolio() {
        $portfolio = UserPortofolio::where('user_id',Auth::user()->id)->orderby('id','desc')->get();        
        return view('clients.portfolio', compact('portfolio'));
    }
    public function portfolio_add() {
        $allSkills = Skill::where('active',1)->get();
        return view('clients.portfolio_add', compact('allSkills'));
    }
    public function portfolio_insert(Request $request) {
        $this->validate($request, [          
           'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           'title' => 'required|max:255',
           'link' => 'max:255',   
           'skills_in' =>'required'
        ]);
        
        $img_name = time().'.'.$request->file('file')->getClientOriginalExtension();
        $request->file('file')->move(base_path().'/public/uploads/',$img_name);   
        
        $userPorfolio = new UserPortofolio();
        $userPorfolio->title = $request->title;
        $userPorfolio->description = $request->description;
        $userPorfolio->user_id = Auth::user()->id;
        $userPorfolio->link = $request->link;
        $userPorfolio->end_date = $request->end_date;        
        $userPorfolio->img = $img_name;
        if($request->skills_in != null)
            $userPorfolio->skills_in = implode(',', $request->skills_in);
        else $userPorfolio->skills_in = '';
        $userPorfolio->save();
        return back()->with('success','لقد تمت اضافة عمل الى معرض أعمالك');
    }
    public function portfolio_changeStatus(Request $request) {
        $item_id = $request->input('item_id');
        $item = UserPortofolio::find($item_id);
        if($item->publish == 1) $publish = 0; else $publish = 1;
        $item->publish = $publish;
        $item->save();
    }
    public function portfolio_delete(Request $request) {
        $item = UserPortofolio::find($request->input('item_id'));
        $item->delete();
    }
    public function portfolio_edit(UserPortofolio $item) {
        $allSkills = Skill::where('active',1)->get();
        $mySkills = explode(',', $item->skills_in);
        
        return view('clients.portfolio_update', compact('allSkills','item','mySkills'));
    }
    public function portfolio_update(Request $request, UserPortofolio $item) { 
          $this->validate($request, [                    
           'title' => 'required|max:255',
           'link' => 'max:255',   
           'skills_in' =>'required'
        ]);
        if(!$request->skills_in)
            $item->update($request->all());
       if($request->skills_in != null)
            $item->skills_in = implode(',', $request->skills_in);
        else $item->skills_in = '';
         $item->save();
        return back()->with('success','تم تحديث بيانات العمل بنجاح');
    }
}
