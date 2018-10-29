<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Budget;
use App\Skill;
use App\Project;
use Auth;
use Illuminate\Support\Facades\Input;

class ProjectsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function project_add() {
        $categories = Category::where('active',1)->get();
        $budgets = Budget::all();
        $skills = Skill::where('active','1')->get();        
        return view('clients.project_add', compact('categories','budgets','skills'));        
    }
    public function project_insert(Request $request) {
        $this->validate($request, [  
           'name' => 'required',
           'description' => 'required' ,
           'file' => 'mimes:jpeg,png,jpg,zip,pdf|max:2048',
        ]); 
         
        $project = new Project;
        $project->category = $request->category;
        $project->name = $request->name;
        $project->user_id = Auth::user()->id;
        $project->budget_id = $request->budget_id;
        $project->duration = $request->duration;
        $project->description = $request->description;
        if($request->skills != null)
            $project->skills = implode(',', $request->skills);
        else $project->skills = '';
        
        if($request->hasFile('file')){
            $file_name = time().'.'.$request->file('file')->getClientOriginalExtension();
            $request->file('file')->move(base_path().'/public/uploads/',$file_name);   
            $project->file = $file_name;
         }
        $project->save();
        return back()->with('success','لقد تم اضافة مشروعك بنجاح');
    }
    
    public function my_projects() {
        $items = Project::join('status','status.id','=','projects.status')                    
                    ->join('budgets','budgets.id','=','projects.budget_id')      
                    ->where('projects.user_id','=',Auth::user()->id)
                    ->orderby('projects.id','desc')
                    ->get(['projects.name as projName','projects.id as projID','budgets.name as budgName',
                        'projects.*','status.*']);
        return view('clients.my_projects', compact('items'));
    }
     
    public function my_projects_edit(Project $item) {
        $categories = Category::where('active',1)->get();
        $budgets = Budget::all();
        $skills = Skill::where('active','1')->get(); 
        $mySkills = explode(',', $item->skills);
        return view('clients.project_update', compact('item','categories','budgets','skills','mySkills'));
    }
    public function my_projects_update(Request $request, Project $item) {
//        if( Input::get('skills')){
//            if($request->skills != null)
//                $item->skills = implode(',', $request->skills);
//            else $item->skills = '';
//            $item->save();
//        }else
//            $item->update($request->all());
        
        $this->validate($request, [  
           'name' => 'required',
           'description' => 'required' ,
           'file' => 'mimes:jpeg,png,jpg,zip,pdf|max:2048',
        ]); 
                 
        $item->category = $request->category;
        $item->name = $request->name;        
        $item->budget_id = $request->budget_id;
        $item->duration = $request->duration;
        $item->description = $request->description;
        if($request->skills != '')
            $item->skills = implode(',', $request->skills);
        else $item->skills = '';
         
         if($request->hasFile('file')){
             if($item->file != null){
                $file_path = public_path().'/uploads/'.$item->file;
                if(file_exists($file_path))
                    unlink($file_path);
            }
            $img_name = time().'.'.$request->file('file')->getClientOriginalExtension();
            $request->file('file')->move(base_path().'/public/uploads/',$img_name);   
            $item->file = $img_name;
        }
         
        $item->save();
        
        return back()->with('success','لقد تم التعديل بنجاح');
    }
}
