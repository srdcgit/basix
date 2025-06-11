<?php

namespace App\Models;

use App\Helpers\ImageHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date_of_event',
        'geo_location',
        'level_of_training',
        'state_id',
        'district_id',
        'block_id',
        'village_id',
        'type',
        'facilitator_name',
        'is_co_facilitator_name',
        'co_facilitator_name',
        'name',
        'objective',
        'type_of_participants',
        'number_of_participants',
        'number_of_male',
        'number_of_female',
        'image',
        'is_validate'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function state()
    {
        return $this->belongsTo(State::class,'state_id');
    }
    public function district()
    {
        return $this->belongsTo(District::class,'district_id');
    }
    public function block()
    {
        return $this->belongsTo(Block::class,'block_id');
    }
    public function village()
    {
        return $this->belongsTo(Village::class,'village_id');
    }
    public function setImageAttribute($value){
        $this->attributes['image'] = ImageHelper::saveImage($value,'/uploaded_images/training_reports/');
    }
}
