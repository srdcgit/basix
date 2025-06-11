<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Village;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function getLocationReport()
    {
        return view('admin.reports.location_report');
    }
    public function getVillagesData(Request $request)
    {
        if($request->gram_panchyat_id)
        {
            $villages = Village::where('gram_panchyat_id',$request->gram_panchyat_id)->get();
        }else{
            $villages = Village::all();
        }
        $html = view('admin.reports.partials.village_table',compact('villages'))->render();
        return response()->json([
            'html' => $html,
        ]);
    }
}
