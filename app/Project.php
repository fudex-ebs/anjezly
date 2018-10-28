<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected  $fillable = ['category','name','user_id','status','budget_id','duration','description','skills','file'];
}
