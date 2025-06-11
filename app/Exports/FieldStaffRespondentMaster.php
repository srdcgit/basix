<?php

namespace App\Exports;

use App\Models\RespondentMaster;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FieldStaffRespondentMaster implements FromCollection , WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return \DB::table('users')
            ->join('respondent_masters', 'users.id', '=', 'respondent_masters.user_id')
            ->join('farming_profiles', 'respondent_masters.id', '=', 'farming_profiles.respondent_master_id')
            ->leftJoin('blocks', 'respondent_masters.block_id', '=', 'blocks.id')
            ->leftJoin('districts', 'respondent_masters.district_id', '=', 'districts.id')
            ->leftJoin('gram_panchyats', 'respondent_masters.gram_panchyat_id', '=', 'gram_panchyats.id')
            ->leftJoin('villages', 'respondent_masters.village_id', '=', 'villages.id')
            ->where('users.field_staff_id', '=', auth()->user()->id)
            ->select(
                'respondent_masters.farmer_id',
                'respondent_masters.name',
                'farming_profiles.head_of_hh',
                'blocks.name as block_name',
                'districts.name as district_name',
                'gram_panchyats.name as gram_panchyat_name',
                'villages.name as village_name',
                'respondent_masters.gender',
                'respondent_masters.age',
                'respondent_masters.education',
                'respondent_masters.number_family_member',
                'respondent_masters.caste',
                'respondent_masters.religion',
                'respondent_masters.is_validate'
            )
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Head of HH',
            'Block',
            'District',
            'Gram Panchyat',
            'Village',
            'Gender',
            'Age',
            'Education',
            'Number of Family Members',
            'Caste',
            'Religion',
            'Is Validate',
        ];
    }

}
