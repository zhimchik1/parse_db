<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class FileController extends Controller
{

    public function removeFile(Request $request){}

    public function export(){}

    public function removeExport(Request $request){}

    public function downloadExportFile(Request $request){}

}
