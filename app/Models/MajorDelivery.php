<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MajorDelivery extends Model
{
    use HasFactory;

    protected $fillable = ['project_id','deliverable','date'];
    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date' => 'date',
    ];
    
    public function project()
    {
        return $this->belongsTo(Project::class,'project_id');
    }
}
