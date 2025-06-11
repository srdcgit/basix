<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmingYearling extends Model
{
    use HasFactory;

    protected $fillable = ['year','figerlings','yearlings','farming_profile_id'];

    public function farming_profile()
    {
        return $this->belongsTo(FarmingProfile::class,'farming_profile_id');
    }
}
