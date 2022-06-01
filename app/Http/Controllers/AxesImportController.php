<?php

namespace App\Http\Controllers;

use App\Imports\AxesImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class AxesImportController extends Controller
{
    public function import()
    {
        $request = request();
        if (!$request->hasFile('file')) {
            return back()->withErrors(['file' => 'File is required.']);
        }
        if (!$request->has('type')) {
            return back()->withErrors(['type' => 'Type is required.']);
        }
        $type = $request->get('type');
        Excel::import(new AxesImport($type), request()->file('file'));
        return redirect('/axes')->with('success', 'All good!');
    }
}
