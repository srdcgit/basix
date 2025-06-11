<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectVillage extends Model
{
    use HasFactory;
    
    protected $fillable = ['project_id','village_id'];

    public function project()
    {
        return $this->belongsTo(Project::class,'project_id');
    }
    public function village()
    {
        return $this->belongsTo(Village::class,'village_id');
    }
}
