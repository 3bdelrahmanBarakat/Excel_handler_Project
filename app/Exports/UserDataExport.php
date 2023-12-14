<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserDataExport implements FromArray, WithHeadings
{
    private $data;
    private $columnNames;

    public function __construct(array $columnNames, array $data)
    {
        $this->columnNames = $columnNames;
        $this->data = $data;
    }

    public function array(): array
    {
        return $this->data;
    }

    public function headings(): array
    {
        return $this->columnNames;
    }
}
