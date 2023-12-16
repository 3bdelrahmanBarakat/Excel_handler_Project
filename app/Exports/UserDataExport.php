<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserDataExport implements FromArray, WithHeadings
{
    protected $columnMap;

    public function __construct(array $columnMap)
    {
        $this->columnMap = $columnMap;
    }

    public function array(): array
    {
        $transposedData = array_map(null,...array_values($this->columnMap));

        return $transposedData;
    }

    public function headings(): array
    {
        return array_keys($this->columnMap);
    }

    
}
