<?php

namespace App\Http\Controllers;

use App\Imports\ReposImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReposImportController extends Controller
{
    public function import()
    {
        // validate request
        $request = request();
        if (!$request->hasFile('file')) {
            // return with error
            return back()->withErrors(['file' => 'File is required.']);
        }
        Excel::import(new ReposImport, request()->file('file'));
        return redirect('/repos')->with('success', 'All good!');
    }
}
