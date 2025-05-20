<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use ZipArchive;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;

class DBArchiveController extends Controller
{
    public function index()
    {
        return view('db-archive.db-archive');
    }

    public function exportTablesData(Request $request)
    {
        //        dd($request->all());

        if (isset($request->filter)) {
            $validator = Validator::make($request->all(), [
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
            ]);
            if ($validator->fails()) {
                Alert::toast($validator->errors()->first(), 'error')->width('375px');
                return redirect()->back();
            }

        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        $zipFileName = 'db-archive-' . $startDate->format('Y-m-d') . '-' . $endDate->format('Y-m-d') . '.csv.zip';
        } else {
            $zipFileName = 'db-archive-' . Carbon::now()->format('Y-m-d') . '.csv.zip';
        }
        //        dd($startDate, $endDate);

        $tables = Schema::getAllTables();


        $folder = public_path('db-archive');
        if (!file_exists($folder)) {
            if (!mkdir($folder, 0777, true) && !is_dir($folder)) {
                return response()->json(['error' => 'Failed to create directory.'], 500);
            }
        }
        $zipFilePath = $folder . '/' . $zipFileName;
        $zip = new ZipArchive();


        if ($zip->open($zipFilePath, ZipArchive::CREATE) !== true) {
            return response()->json(['error' => 'Failed to create the zip file.'], 500);
        }

        foreach ($tables as $table) {
            $tableName = $table->Tables_in_takecare;
            $fileName = $tableName . '.csv';
            $filePath = $folder . '/' . $fileName;

            if (isset($request->all)) {
                if ($tableName != 'migrations') {
                    $tableData = DB::table($tableName)
                        ->get()
                        ->toArray();
                }
            } else {
                if ($tableName != 'migrations') {
                    $tableData = DB::table($tableName)
                        ->whereBetween('created_at', [$startDate, $endDate])
                        ->get()
                        ->toArray();
                }
            }


            if (!empty($tableData)) {
                $file = fopen($filePath, 'w');
                fputcsv($file, array_keys((array)$tableData[0]));
                foreach ($tableData as $row) {
                    fputcsv($file, (array)$row);
                }
                fclose($file);

                $zip->addFile($filePath, $fileName);
            } else {
                continue;
            }
        }

        $zip->close();

        foreach ($tables as $table) {
            $tableName = $table->Tables_in_takecare;
            $fileName = $tableName . '.csv';
            $filePath = $folder . '/' . $fileName;

            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }
}
