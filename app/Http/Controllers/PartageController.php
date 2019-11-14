<?php

namespace App\Http\Controllers;

use App\Partage;
use App\User;
use Illuminate\Http\Request;

class PartageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        $partages = Partage::where('users_has_livres_id', $request->users_has_livres_id)->get()->toArray();
        if(count($partages) < 3){
            $partage = new Partage();
            $partage->users_has_livres_id = $request->users_has_livres_id;
            $partage->user_id = $request->user_id;
            $partage->save();

            //Envoie d'une notification
            return response()->json(array(
                'message'   => 'Partage effectué. '
                    . User::find($request->user_id)->name . ' reçevra une notification.'
            ), 201);
        }else{
            return response()->json(array(
                'message'   => 'Oups, la limite de partage pour cet article est atteinte. Désolé'
            ), 301);
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
