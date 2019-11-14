<?php

namespace App\Http\Controllers;

use App\Age;
use App\Categorie;
use App\Contenu;
use App\Livre;
use App\LivresHasAge;
use App\LivresHasCategorie;
use App\Texte;
use App\UsersHasLivre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mockery\CountValidator\Exception;

class LivreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Récupération d'un livre en fonction d'une catégorie
        if($request->category){
            $category = new Categorie();
            return response()->json(array('livres', $category->livres($request->category)), 201);
        }

        // Récupération des livres en fonction de l'age
        if($request->age){
            $age = new Age();
            return response()->json(array('ages', $age->livres($request->age)), 201);
        }
        return response()->json(array('livres' => Livre::all()), 201);
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
        DB::beginTransaction();
        try{
            $livre = new Livre();
            $livre->titre = $request->titre;
            $livre->description = $request->description;
            $livre->auteur_id   = $request->auteur_id;
            $livre->save();

            $livreHasCategorie = new LivresHasCategorie();
            $livreHasCategorie->livre_id = $livre->id;
            $livreHasCategorie->categorie_id = $request->categorie_id;
            $livreHasCategorie->save();

            $livreHasAge = new LivresHasAge();
            $livreHasAge->livre_id = $livre->id;
            $livreHasAge->age_id = $request->age_id;
            $livreHasAge->save();

            DB::commit();
            return response()->json(array(
                'message'   => 'Le livre a été enregistré. Merci'
            ), 201);
        }catch (Exception $e){
            Log::error($e);
            DB::rollBack();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {

        if($request->position_id) {
            //Récupération du livre et du contenu en fonction de la langue;
            $contenu =  Contenu::where('position', $request->position_id)
                ->where('langue_id', intval($request->language_id))
                ->where('livre_id', intval($id))
                ->get();
            dd($contenu);
            if(is_null($contenu)){
                return response()->json(array('message' => 'Ce livre n\'est pas traduit dans cette langue'), 301);
            }else{
                $textes = Texte::where('contenu_id', $contenu->id)->where('langue_id', intval($request->language_id))->get();
            }

            dd($textes, $contenu);
        }

        $livre = Livre::find($id);
        if(is_null($livre)){
            return response()->json(array('message' => 'Resource non disponible'), 201);
        }




        return response()->json(array(
            'livre'     => $livre,
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


    public function achatLivre(Request $request) {
        $userHasLivre = new UsersHasLivre();
        $userHasLivre->user_id = $request->user_id;
        $userHasLivre->livre_id = $request->livre_id;
        $userHasLivre->save();

        //Partage du livre  aux membre de la famille.
        return response()->json(array(
            'message'   => "Merci pour votre achat et bonne lecture."
        ), 201);
    }
}
