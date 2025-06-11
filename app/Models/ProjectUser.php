<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','project_id'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function project()
    {
        return $this->belongsTo(Project::class,'project_id');
    }
    public function project_user_executives()
    {
        return $this->hasMany(ProjectUserExecutive::class,'project_user_id');
    }
    public function project_user_field_staffs()
    {
        return $this->hasMany(ProjectUserFieldStaff::class,'project_user_id');
    }
}
