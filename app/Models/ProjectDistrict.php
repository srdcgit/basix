<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectDistrict extends Model
{
    use HasFactory;
    protected $fillable = ['project_id','district_id'];

    public function district()
    {
        return $this->belongsTo(District::class,'district_id');
    }
    public function project()
    {
        return $this->belongsTo(Project::class,'project_id');
    }
}
