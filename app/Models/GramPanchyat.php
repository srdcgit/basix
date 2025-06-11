<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GramPanchyat extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function block()
    {
        return $this->belongsTo(Block::class,'block_id');
    }
    public function getUserCount($role_id)
    {
        $userIds = User::where('role_id',$role_id)->get()->pluck('id')->toArray();
        return UserGramPanchyat::whereIn('user_id',$userIds)
                    ->where('gram_panchyat_id',$this->id)->count();
    }
}
