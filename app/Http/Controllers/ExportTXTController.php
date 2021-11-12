<?php

namespace App\Http\Controllers;

use App\Models\Export;
use Illuminate\Http\Request;

class ExportTXTController extends ExportController
{

    public function GenerateExport($data)
    {
        $fileName = 'ExportTXT.txt';
        $fp = fopen(storage_path() . "/export/" . $fileName, "w");
        $output = "";
        foreach ($data AS $line) {
            $output .= "Title \r\n " . $line['Title'] . "\r\n" . "News \r\n" . $line['News'] . "\r\n";
        }
        fwrite($fp, $output);
        fclose($fp);

        Export::firstOrCreate(
            ['file_name' => $fileName],
            ['format' => 'txt', 'updated_at' => time()]
        );

        return $fileName;
    }
}
