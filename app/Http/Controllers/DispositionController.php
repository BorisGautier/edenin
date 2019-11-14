<?php

namespace App\Http\Controllers;

use App\Disposition;
use Illuminate\Http\Request;

class DispositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(array('dispositions' => Disposition::all()), 201);
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
        $disposition = new Disposition();
        $disposition->label = $request->label;
        $disposition->description = $request->description;
        $disposition->save();
        return response()->json(array(
            'message'       => 'Nouvelle disposition enregistrée.',
            'disposition'   => $disposition
        ), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $disposition = Disposition::find($id);
        $disposition->label = $request->label;
        $disposition->description = $request->description;
        $disposition->save();
        return response()->json(array(
            'message'       => 'Mise à jour effectuée.',
            'disposition'   => $disposition
        ), 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Disposition::destroy($id);
        return response()->json(array(
            'message'       => 'Le modèle de disposition a été supprimé.',
            'dispositions'  => Disposition::all()
        ), 201);
    }
}
