<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Validator;

class AuthController extends Controller
{
    public $successStatus = 200;

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'name'           => 'required',
                'email'          => 'required|email',
                'password'       => 'required',
                'ville'          => 'required',
                'date_naissance' => 'required|date',
                'c_password'     => 'required|same:password',
            ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);}
        $input             = $request->all();
        $input['password'] = bcrypt($input['password']);
        $name              = 'avatar';
        $data              = explode(',', $input['avatar']);
        $content           = base64_decode($data[1]);
        Storage::makeDirectory('storage/avatar/' . $input['name'], 0777, true);
        Storage::disk('public')->put("storage/avatar" . "/" . $input['name'] . "/" . $name . ".jpg", $content);
        $input['avatar']  = Storage::url("app/public/storage/avatar" . "/" . $input['name'] . "/" . $name . ".jpg");
        $user             = User::create($input);
        $success['token'] = $user->createToken('Edenin')->accessToken;
        return response()->json(['success' => $success], 201);
    }

    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user   = Auth::user();
            $token  = $user->createToken('Edenin')->accessToken;
            $name   = $user->name;
            $avatar = Env('APP_URL') . $user->avatar;
            return response()->json(['token' => $token, 'name' => $name, 'avatar' => $avatar], $this->successStatus);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function getUser()
    {
        $user = Auth::user();
        return response()->json(['user' => $user], $this->successStatus);
    }

    public function logoutApi()
    {

        $user = Auth::user()->token();
        $user->revoke();
        return response()->json(['success' => "déconnecté"], $this->successStatus);

    }
}
