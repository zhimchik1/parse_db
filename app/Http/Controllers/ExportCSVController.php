<?php

namespace App\Http\Controllers;

use App\Models\Export;
use Illuminate\Http\Request;

class ExportCSVController extends ExportController
{

    public function GenerateExport($data)
    {
        $fileName = 'ExportCSV.csv';
        $f = fopen(storage_path() . "/export/" . $fileName, 'w');
        fputcsv($f, array_keys($data[0]));
        foreach ($data as $new) {
            fputcsv($f, $new);
        }
        fclose($f);

        Export::firstOrCreate(
            ['file_name' => $fileName],
            ['format' => 'csv', 'updated_at' => time()]
        );

        return $fileName;
    }
}
