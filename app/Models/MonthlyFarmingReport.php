<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyFarmingReport extends Model
{
    use HasFactory;
    protected $fillable = [
        'month',
        'respondent_master_id',
        'date_of_update',
        'location',
        'lat',
        'long',
        'is_stocking',
        'catia_fry',
        'rahu_fry',
        'mirgal_fry',
        'common_carp_fry',
        'other_fry',
        'hr_fry',
        'fry_quantity',
        'fry_rate',
        'fry_amount',
        'is_hydrological',
        'temp',
        'ph',
        'do',
        'transperency',
        'water_depth',
        'is_providing_feed',
        'number_of_feed',
        'mash_feed_quantity',
        'mash_feed_rate',
        'mash_feed_amount',
        'commerical_feed_quantity',
        'commerical_feed_rate',
        'commerical_feed_amount',
        'mineral_quantity',
        'mineral_rate',
        'mineral_amount',
        'is_lime_applied',
        'lime_quantity',
        'lime_rate',
        'lime_amount',
        'is_netting',
        'c',
        'r',
        'm',
        'cc',
        'o',
        'is_bath',
        'disease',
        'action_for_disease',
        'netting_expenditure',
        'fish_quantity',
        'fish_rate',
        'fish_amount',
        'is_pond_preparation',
        'boundary_cleaning_expenditure',
        'fym_application_expenditure',
        'is_fyk_applied',
        'fyk_expenditure',
        'is_disease_indentified',
        'user_id',
        'is_validate'
    ];
    
    protected $casts = [
        'date_of_update' => 'datetime'
    ];
    public function respondent_master()
    {
        return $this->belongsTo(RespondentMaster::class,'respondent_master_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
