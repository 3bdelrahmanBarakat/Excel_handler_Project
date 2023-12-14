<?php
namespace App\Imports;

use App\Models\UserData;
use Maatwebsite\Excel\Concerns\ToModel;

class UserDataImport implements ToModel
{


    public function model(array $row)
    {
        return new UserData([
            'full_name' => $row[0],
            'phone_number' => $row[1],
            'email' => $row[2],
        ]);
    }
}
