<?php

namespace App\Http\Controllers\WebApp;

namespace App\Http\Controllers\User;

use App\Http\Controllers\Extendables\BaseController;
use App\Models\Database\Content\GuestNote;
use App\Models\Database\User\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use GenTux\Jwt\GetsJwtToken;

class ProfileController extends BaseController
{
    use GetsJwtToken;

    /*
     * GET resource
     */
    public function index(Request $request)
    {
        $payload = $this->jwtPayload();
        $userUuid = $payload['sub'];

        $request->merge(['user_uuid' => $userUuid]);
        $this->validate($request, [
            'user_uuid' => 'required|string|size:36'
        ]);

        try{
            $user = User::where('uuid', '=', $request->get('user_uuid'))->firstOrFail();
        }
        catch(ModelNotFoundException $e){
            throw new Exception('This account doesn\'t exist');
        }

        return $this->jsonResponse($user, 200);
    }

    /*
     * POST resource
     */
    public function store(Request $request)
    {
        $payload = $this->jwtPayload();
        $userUuid = $payload['sub'];

        $request->merge(['user_uuid' => $userUuid]);
        $this->validate($request, [
            'user_uuid' => 'required|string|size:36',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'username' => 'required|string|min:8',
        ]);

        try{
            $user = User::where('uuid', '=', $request->get('user_uuid'))->firstOrFail();
        }
        catch(ModelNotFoundException $e){
            throw new Exception('This account doesn\'t exist');
        }

        $user->update($request->except('author_uuid'));

        return $this->jsonResponse($user, 200);
    }
}
