<?php

namespace App\Models;

use App\Helpers\ImageHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespondentMaster extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','block_id','district_id','gram_panchyat_id','village_id','gender','age','education',
        'number_family_member','caste','religion','farmer_id','image','api_id','user_id',
        'is_validate'
    ];
    public function setImageAttribute($value){
        $this->attributes['image'] = ImageHelper::saveImage($value,'/uploaded_images/profiles/');
    }
    public function block()
    {
        return $this->belongsTo(Block::class,'block_id');
    }
    public function district()
    {
        return $this->belongsTo(District::class,'district_id');
    }
    public function gram_panchyat()
    {
        return $this->belongsTo(GramPanchyat::class,'gram_panchyat_id');
    }
    public function village()
    {
        return $this->belongsTo(Village::class,'village_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','field_staff_id');
    }
    public function farming_profile()
    {
        return $this->hasMany(FarmingProfile::class,'respondent_master_id','id');
    }
    

}
