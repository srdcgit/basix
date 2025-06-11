<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectGramPanchyat extends Model
{
    use HasFactory;

    protected $fillable = ['project_id','gram_panchyat_id'];

    public function project()
    {
        return $this->belongsTo(Project::class,'project_id');
    }
    public function gram_panchyat()
    {
        return $this->belongsTo(GramPanchyat::class,'gram_panchyat_id');
    }
}
