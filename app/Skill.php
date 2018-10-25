<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = ['title','active'];
//    public function userSkills() {
//        return $this->belongsToMany(SkillsUser::class);
//    }
}
