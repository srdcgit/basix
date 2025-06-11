<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PondPreparation extends Model
{
    use HasFactory;

    protected $fillable = [
        'respondent_master_id',
        'date_of_update',
        'location',
        'lat',
        'long',
        'repair_pond_boundary',
        'date_of_pond_boundary',
        'expenditure_of_pond_boundary',
        'observation_of_pond_boundary',
        'remove_black_soil',
        'date_black_soil',
        'expenditure_black_soil',
        'observation_of_black_soil',
        'is_sun_drying',
        'from_sun_drying',
        'to_sun_drying',
        'is_done_liming',
        'done_liming_quantity',
        'done_liming_rate',
        'done_liming_expenditure',
        'is_cow_dung',
        'cow_dung_quantity',
        'cow_dung_rate',
        'cow_dung_expenditure',
        'is_apply_npk',
        'urea_quantity',
        'urea_rate',
        'urea_expenditure',
        'ssp_quantity',
        'ssp_rate',
        'ssp_expenditure',
        'potas_quantity',
        'potas_rate',
        'potas_expenditure',
    ];
    
    protected $casts = [
        'date_of_update' => 'datetime',
        'date_black_soil' => 'date',
        'date_of_pond_boundary' => 'date',
        'from_sun_drying' => 'date',
        'to_sun_drying' => 'date',
    ];
    public function respondent_master()
    {
        return $this->belongsTo(RespondentMaster::class,'respondent_master_id');
    }
}
