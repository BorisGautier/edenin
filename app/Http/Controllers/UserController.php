<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(array('users' => User::all()), 201);
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
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->numero = $request->numero;
        $user->ville = $request->ville;
        $user->date_naissance = Carbon::parse();
        $user->password = bcrypt($request->password);
        $user->save();
        return response()->json(array(
            'user'      => $user,
            'message'   => 'Bienvenu sur Edenin, votre plateforme de lecture'
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
        $user = User::find($id);
        return response()->json(array(
            'user' => $user,
            'livres'    => $user->livres,
            'partages'  => $user->partages,
            'commentaires'  => $user->commentaires,
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
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->numero = $request->numero;
        $user->ville = $request->ville;
        $user->date_naissance = Carbon::parse($user->date_naissance);
        $user->password = bcrypt($request->password);
        $user->save();
        return response()->json(array(
            'user'      => $user,
            'message'   => 'Mise à jour effectuée.'
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
        //
    }
}
