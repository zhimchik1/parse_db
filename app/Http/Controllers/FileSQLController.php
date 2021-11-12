<?php

namespace App\Http\Controllers;

use App\Models\Export;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class FileSQLController extends FileController
{
    public function removeFile(Request $request)
    {
        $file = $request->input('file');
        $message = '';

        if (isset($file)) {
            Storage::disk('db')->delete($file);
            File::where('name', $file)->delete();
            $message .= 'Dump file with name ' . $file . ' has been deleted <br>';

            return redirect()->back()->with('success_file', $message);

        } else {
            return redirect()->back()->with('danger_file', 'Nothing to delete');
        }
    }
    public function export()
    {
        $tables = DB::connection('mysql2')->select('SHOW TABLES');
        $tableName = "Tables_in_" . DB::connection('mysql2')->getDatabaseName();
        $news = [];

        foreach ($tables as $table) {
            if (preg_match_all('/posts/', $table->$tableName) == 1) {
                $rows = DB::connection('mysql2')
                    ->table($table->$tableName)
                    ->select("post_title", "post_content")
                    ->get();

                foreach ($rows as $row) {
                    $row->post_title = preg_replace('#<a.*?>.*?</a>#i', '', $row->post_title);
                    $row->post_title = preg_replace("/<img[^>]+\>/i", "(image) ", $row->post_title);
                    $row->post_content = preg_replace('#<a.*?>.*?</a>#i', '', $row->post_content);
                    $row->post_content = preg_replace("/<img[^>]+\>/i", "(image) ", $row->post_content);
                    if (isset($row->post_title) && isset($row->post_content)) {
                        $news[] = [
                            'Title' => $row->post_title,
                            'News' => $row->post_content
                        ];
                    }
                }
            }
        }
        $generateCSV = new ExportCSVController();
        $generateCSV->GenerateExport($news);

        $generateXML = new ExportXMLController();
        $generateXML->GenerateExport($news);

        $generateTXT = new ExportTXTController();
        $generateTXT->GenerateExport($news);

        return redirect('home')->with('status_export', 'Export update');
    }

    public function removeExport(Request $request)
    {
        $file = $request->input('file');
        $message = '';

        if (isset($file)) {
            $data = Export::find($file);
            Storage::disk('export')->delete($data->file_name);
            $message .= 'Export file with name ' . $data->file_name . ' has been deleted <br>';
            $data->delete();

            return redirect()->back()->with('success_removeExport', $message);
        } else {
            return redirect()->back()->with('danger_removeExport', 'Nothing to delete');
        }
    }

    public function downloadExportFile(Request $request)
    {
        $file = $request->input('file');
        $data = Export::find($file);
        $downloadFile = Storage::disk('export')->exists($data->file_name);

        if($downloadFile == true){
            $downloadFile = storage_path() . "/export/" . $data->file_name;
            $headers = array(
                'Content-Type: application/pdf',
            );

            return Response::download($downloadFile, $data->file_name, $headers);
        } else {
            return redirect()->back()->with('danger_downloadExportFile', 'File not exist');
        }


    }




}
