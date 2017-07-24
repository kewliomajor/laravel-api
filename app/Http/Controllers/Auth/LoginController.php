<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Extendables\BaseController;
use App\Models\Database\User\User;
use GenTux\Jwt\JwtToken;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Exception;

class LoginController extends BaseController
{

    /*
     * GET resource
     */
    public function index(JwtToken $jwt, Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string|min:8',
            'password' => 'required|min:8'
        ]);

        try{
            $user = User::with('password')->where('username', '=', $request->get('username'))->firstOrFail();
            $dbPassword = $user->password->password;
        }
        catch(ModelNotFoundException $e){
            throw new Exception('Username or password is incorrect');
        }

        if (Hash::check($request->get('password'),$dbPassword)){
            $token = $jwt->createToken($user);
        }
        else{
            throw new Exception('Username or password is incorrect');
        }

        return $this->jsonResponse(['jwt' => $token], 200);
    }
}
