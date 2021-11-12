<?php

namespace App\Http\Controllers;

use App\Models\Dump;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DumpController extends Controller
{

    public function import(Request $request)
    {
        $files = $request->input('status');
        $message = '';
        if (isset($files)) {

            foreach ($files as $file) {
                $sql_dump = Storage::disk('db')->get($file);

                if (Dump::where('file_name', $file)->first()) {
                    $message .= 'Already ingest ' . $file . '<br>';
                    continue;
                }
                if (isset($sql_dump)) {
                    DB::connection('mysql2')->getPdo()->exec($sql_dump);
                    Dump::create([
                        'file_name' => $file,
                        'status' => 1
                    ]);
                    $message .= 'Now ingested ' . $file . '<br>';
                }
            }
            return redirect()->back()->with('success_ingest', $message);
        }
        return redirect()->back()->with('danger_ingest', 'Nothing ingest!');
    }


    public function remove(Request $request)
    {
        $files = $request->input('dump');
        $message = '';

        if (isset($files)) {
            foreach ($files as $file) {
                $dump = Dump::findOrFail($file);
                $message .= 'Dump file with name ' . $dump->file_name . ' has been deleted <br>';
                $dump->delete();
            }
            return redirect()->back()->with('success_dump', $message);
        } else {
            return redirect()->back()->with('danger_dump', 'Nothing to delete');
        }
    }
}
