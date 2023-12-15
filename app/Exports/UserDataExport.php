<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserDataExport implements FromArray, WithHeadings
{
    private $data;
    private $columnNames;
    private $columnMap;

    public function __construct(array $columnNames, array $data,array $columnMap)
    {
        $this->columnNames = $columnNames;
        $this->data = $data;
        $this->columnMap = $columnMap;
    }

    public function array(): array
    {
        $exportData = [];

        foreach ($this->columnMap as $index => $value) {

            $exportData[$value] = $this->data[$index] ?? [];
        }
        return $exportData;
    }

    public function headings(): array
    {
        return $this->columnNames;
    }
}
