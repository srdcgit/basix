<?php

namespace App\Exports;

use App\Models\RespondentMaster;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CrpRespondentMaster implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return RespondentMaster::with(['farming_profile','block', 'district', 'gram_panchyat', 'village'])
            ->where('user_id', Auth::id())
            ->get()
            ->map(function ($respondent) {
                return [
                    'id' => $respondent->farmer_id,
                    'name' => $respondent->name,
                    'Head of HH' => $respondent->farming_profile->first()?->head_of_hh,
                    'block_name' => $respondent->block->name ?? 'N/A',
                    'district_name' => $respondent->district->name ?? 'N/A',
                    'gram_panchyat_name' => $respondent->gram_panchyat->name ?? 'N/A',
                    'village_name' => $respondent->village->name ?? 'N/A',
                    'gender' => $respondent->gender,
                    'age' => $respondent->age,
                    'education' => $respondent->education,
                    'number_family_member' => $respondent->number_family_member,
                    'caste' => $respondent->caste,
                    'religion' => $respondent->religion,
                    'is_validate' => $respondent->is_validate,
                ];
            });
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
            'Is Validate'
        ];
    }
}
