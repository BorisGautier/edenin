<?php

namespace App\Http\Controllers;

use App\Contenu;
use Illuminate\Http\Request;

class ContenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $contenu = new Contenu();
        $contenu->livre_id = $request->livre_id;
        $contenu->langue_id = $request->langue_id;
        $contenu->disposition_id = $request->disposition_id;
        $contenu->save();

        $temp = Contenu::find($contenu->id);
        $temp->position = $temp->id;
        $temp->save();
        return response()->json(array(
            'message'   => 'Nouveau contenu ajouté à ce livre',
            'contenu'   => $temp
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
        $contenu = Contenu::find($id);
        return response()->json(array(
            'contenu'   => $contenu,
            'livre'     => $contenu->livre,
            'textes'    => $contenu->textes,
            'images'    => $contenu->images,
            'audios'    => $contenu->audios,
            'commentaires'  => $contenu->commentaires
        ), 201);
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
        $contenu = Contenu::find($id);
        $contenu->livre_id = $request->livre_id;
        $contenu->langue_id = $request->langue_id;
        $contenu->disposition_id = $request->disposition_id;
        $contenu->save();

        $temp = Contenu::find($contenu->id);
        $temp->position = $temp->id;
        return response()->json(array(
            'message'   => 'Mise à jour effectuée.',
            'contenu'   => $temp
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
        $temp = Contenu::find($id);
        Contenu::destroy($id);
        return response()->json(array(
            'contenus'   => Contenu::where('livre_id', $temp->livre_id)->get(),
            'message'    => 'Ce contenu à été supprimé.'
        ), 201);
    }
}
