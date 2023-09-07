<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCentresRequest;
use App\Http\Requests\UpdateCentresRequest;
use App\Models\Centres;
use Illuminate\Http\Request;

class CentresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Centres::get();
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
     * @param  \App\Http\Requests\StoreCentresRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCentresRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Centres  $centres
     * @return \Illuminate\Http\Response
     */
    public function show(Centres $centres)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Centres  $centres
     * @return \Illuminate\Http\Response
     */
    public function edit(Centres $centres)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCentresRequest  $request
     * @param  \App\Models\Centres  $centres
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCentresRequest $request, Centres $centres)
    {
        //
        $a = Centres::findOrFail($request->id);
        $a->assessor = $request->assessor;
        $a->save();
        return $a;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Centres  $centres
     * @return \Illuminate\Http\Response
     */
    public function destroy(Centres $centres)
    {
        //
    }

    public function nom(Request $request)
    {
        //
        return Centres::where('assessor',"=",$request->nom)->get();
    }


}
