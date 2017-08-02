<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Extendables\BaseController;
use App\Models\Database\User\Password;
use App\Models\Database\User\User;
use Exception;
use GenTux\Jwt\JwtToken;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class RegisterController extends BaseController
{

    /*
     * POST resource
     */
    public function store(JwtToken $jwt, Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string|min:8',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'password' => 'required|min:8',
        ]);

        $encodedPassword = bcrypt($request->get('password'));

        try{
            $user = User::create($request->except('password'));
        }
        catch(QueryException $e){
            $username = $request->get('username');
            throw new Exception('Username already exists: '.$username);
        }
        $password = Password::create([
            'user_uuid' => $user->uuid,
            'password' => $encodedPassword
        ]);

        $token = $jwt->createToken($user);

        $response = $user->toArray();
        $response['jwt'] = $token;

        return $this->jsonResponse($response, 200);
    }
}
