<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SkillsUser extends Model
{
    protected $fillable = ['user_id','skill_id'];
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function skills() {
        return $this->belongsToMany(Skill::class);
    }
}
