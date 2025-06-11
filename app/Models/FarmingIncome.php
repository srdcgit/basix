<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmingIncome extends Model
{
    use HasFactory;

    protected $fillable = ['year','quantity','rate','amount','farming_profile_id'];
    
    public function farming_profile()
    {
        return $this->belongsTo(FarmingProfile::class,'farming_profile_id');
    }
}
