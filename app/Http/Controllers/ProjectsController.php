<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Budget;
use App\Skill;
use App\Project;
use Auth;

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
        
        $file_name = time().'.'.$request->file('file')->getClientOriginalExtension();
        $request->file('file')->move(base_path().'/public/uploads/',$file_name);   
        
        $project->file = $file_name;
        $project->save();
        return back()->with('success','لقد تم اضافة مشروعك بنجاح');
    }
     
}
