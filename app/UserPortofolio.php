<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPortofolio extends Model
{
    protected $fillable = ['img','user_id','title','description','link','end_date','publish','skills_in'];
    
     public function user() {
        return $this->belongsTo(User::class);
    }
}
