<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class MyDailyReportExport implements FromArray
{
    use Exportable;

    protected $csvdata;

    public function __construct($csvdata)
    {
        $this->csvdata = $csvdata;
    }

    public function array(): array
    {
        return $this->csvdata;
    }
}
