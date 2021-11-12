<?php

namespace App\Http\Controllers;

use App\Models\Dump;
use App\Models\Export;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $dumps = Dump::paginate(10);
        $files = Storage::disk('db')->files();
        $exportFiles = Export::paginate(10);

        return view('home', ['dumps' => $dumps, 'files' => $files,'exportFiles' => $exportFiles]);
    }
}
