<?php

namespace App\Http\Controllers;

use App\Exports\UserDataExport;
use App\Http\Requests\ExportRequest;
use App\Imports\UserDataImport;
use App\Models\UserData;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $userData= UserData::paginate(10);
        return view('dashboard',compact('userData'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file'=> 'required|mimes:csv,xlsx'
        ]);

        $originalColumns = Excel::toArray(new UserDataImport(), $request->file('file'))[0];
        return view('import', compact('originalColumns'));
    }

    public function save(Request $request)
    {
    $request->validate([
        'mapped_columns' => 'required|array',
        'column_records' => 'required|array',
    ]);

    $numRecords = count($request->column_records[$request->column_name]);

    for ($i = 0; $i < $numRecords; $i++) {
        $userData = new UserData();

        foreach ($request->mapped_columns as $originalColumnName => $mappedValue) {
            $record = $request->column_records[$originalColumnName][$i];

            switch ($mappedValue) {
                case 'full_name':
                    $userData->full_name = $record;
                    break;
                case 'phone_number':
                    $userData->phone_number = $record;
                    break;
                case 'email':
                    $userData->email = $record;
                    break;
            }
        }

        $userData->save();
    }

    return to_route('admin.dashboard')->with('message', 'Data imported successfully');
    }


    public function export(ExportRequest $request)
    {


        $columnMap = [];
        if ($request->filled('full_name')) {
            $columnMap[$request->full_name] = $request->checkbox1;
        }

        if ($request->filled('phone_number')) {
            $columnMap[$request->phone_number] = $request->checkbox2;
        }

        if ($request->filled('email_address')) {
            $columnMap[$request->email_address] = $request->checkbox3;
        }



        return Excel::download(new UserDataExport($columnMap), 'users.csv');
    }

}
