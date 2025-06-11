<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;

    protected $guarded = [];

    
    public function district()
    {
        return $this->belongsTo(District::class,'district_id');
    }
    public function getUserCount($role_id)
    {
        $userIds = User::where('role_id',$role_id)->get()->pluck('id')->toArray();
        return UserBlock::whereIn('user_id',$userIds)
                    ->where('block_id',$this->id)->count();
    }
}
