<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBlock extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','block_id'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function block()
    {
        return $this->belongsTo(Block::class,'block_id');
    }
}
