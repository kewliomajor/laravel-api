<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Extendables\BaseController;
use App\Models\Database\User\Password;
use App\Models\Database\User\User;
use Illuminate\Http\Request;

class RegisterController extends BaseController
{

    /*
     * POST resource
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string|min:8',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'password' => 'required|min:8',
        ]);

        $encodedPassword = bcrypt($request->get('password'));

        $user = User::create($request->except('password'));
        $password = Password::create([
            'user_uuid' => $user->uuid,
            'password' => $encodedPassword
        ]);

        return $this->jsonResponse($user, 200);
    }
}
