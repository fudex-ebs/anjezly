<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Budget;
use App\Statu;
use App\User;
use App\Category;
use App\Skill;

class FrontController extends Controller
{
    public function project(Project $item) {
        $budget = Budget::find($item->budget_id);
        $status = Statu::find($item->status);
        $client = User::find($item->user_id);
        $category = Category::find($item->category);
        $skills =  explode(',', $item->skills);
        
        $bidSkills = array();
        foreach ($skills as $value) {
            $skill = Skill::find($value);
            array_push($bidSkills, $skill);
        }        
        
        return view('front.project', compact('item','budget','status','client','category','bidSkills'));
    }
}
