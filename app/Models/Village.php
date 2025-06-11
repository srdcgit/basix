<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function gram_panchyat()
    {
        return $this->belongsTo(GramPanchyat::class,'gram_panchyat_id');
    }
    public function getUserCount($role_id)
    {
        $userIds = User::where('role_id',$role_id)->get()->pluck('id')->toArray();
        return UserVillage::whereIn('user_id',$userIds)
                    ->where('village_id',$this->id)->count();
    }
}
