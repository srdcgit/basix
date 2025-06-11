<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmingProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'respondent_master_id','shg_member','fish_pb_member','head_of_hh','has_hh_bpl_no',
        'has_hh_mgnrega_card','has_hh_bank_account','has_hh_kcc_account','total_annual_income',
        'total_annual_income_from_fishery','involvement_in_fishery','own_water_body',
        'lease_in_water_body','lease_out_water_body','total_water_body','have_pump_set',
        'have_tube_well','fishing_net','aereator','have_boundary_regularly','have_remove_black_soil',
        'have_applied_lime','have_apply_cow_dung','have_regularly_apply_lime','have_regularly_apply_cow_dung',
        'type_of_feed_used','done_feeding_regularly','have_water_ph_regularly','have_meeting_regularly',
        'attend_training_programme','exposure_good_practics','shg_member_name','fish_pb_member_name','project_id',
        'respondent_master_api_id','user_id','is_validate'
    ];

    public function respondent_master()
    {
        return $this->belongsTo(RespondentMaster::class, 'respondent_master_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function project()
    {
        return $this->belongsTo(Project::class,'project_id');
    }
    public function farming_income()
    {
        return $this->hasOne(FarmingIncome::class,'farming_profile_id');
    }
    public function farming_yearling()
    {
        return $this->hasOne(FarmingYearling::class,'farming_profile_id');
    }
}
