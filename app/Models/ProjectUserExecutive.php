<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectUserExecutive extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','project_user_id'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function project_user()
    {
        return $this->belongsTo(ProjectUser::class,'project_user_id');
    }
}
