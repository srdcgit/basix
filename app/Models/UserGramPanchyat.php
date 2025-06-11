<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGramPanchyat extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','gram_panchyat_id'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function gram_panchyat()
    {
        return $this->belongsTo(GramPanchyat::class,'gram_panchyat_id');
    }
}
