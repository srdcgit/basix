<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RespondentMasterExport implements FromCollection, WithHeadings, WithMapping
{
    protected $respondentMasters;

    public function __construct($respondentMasters)
    {
        $this->respondentMasters = $respondentMasters;
    }

    public function collection()
    {
        return $this->respondentMasters;
    }

    public function headings(): array
    {
        return [
            'Farmer ID',
            'Name',
            'District',
            'Block',
            'Gram Panchyat',
            'Village',
        ];
    }

    public function map($respondent_master): array
    {
        return [
            $respondent_master->farmer_id,
            $respondent_master->name,
            $respondent_master->district->name ?? '',
            $respondent_master->block->name ?? '',
            $respondent_master->gram_panchyat->name ?? '',
            $respondent_master->village->name ?? '',
        ];
    }
}

