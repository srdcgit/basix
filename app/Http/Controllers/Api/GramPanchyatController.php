<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GramPanchyat;
use App\Models\UserGramPanchyat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GramPanchyatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $user_gram_panchyat_ids = UserGramPanchyat::where('user_id',Auth::user()->id)->get()->pluck('gram_panchyat_id')->toArray();        
            $gram_panchyats = GramPanchyat::whereIn('id',$user_gram_panchyat_ids)->get();
            return response([
                "gram_panchyats" => $gram_panchyats,
            ], 200);
        } catch (\Exception $e) {
            return response([
                "error" => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GramPanchyat  $gramPanchyat
     * @return \Illuminate\Http\Response
     */
    public function show(GramPanchyat $gramPanchyat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GramPanchyat  $gramPanchyat
     * @return \Illuminate\Http\Response
     */
    public function edit(GramPanchyat $gramPanchyat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GramPanchyat  $gramPanchyat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GramPanchyat $gramPanchyat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GramPanchyat  $gramPanchyat
     * @return \Illuminate\Http\Response
     */
    public function destroy(GramPanchyat $gramPanchyat)
    {
        //
    }
}
