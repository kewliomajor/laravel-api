<?php

namespace App\Http\Controllers\WebApp;

use App\Http\Controllers\Extendables\BaseController;
use App\Models\Database\Content\GuestNote;
use Illuminate\Http\Request;
use GenTux\Jwt\GetsJwtToken;

class GuestbookController extends BaseController
{
    use GetsJwtToken;

    /*
     * GET resource
     */
    public function index()
    {
        return $this->jsonResponse(GuestNote::orderBy('created_at', 'desc')->get(), 200);
    }

    /*
     * POST resource
     */
    public function store(Request $request)
    {
        $payload = $this->jwtPayload();
        $authorUuid = $payload['sub'];

        $request->merge(['author_uuid' => $authorUuid]);
        $this->validate($request, [
            'author_uuid' => 'required|string|size:36',
            'text' => 'required|string',
        ]);

        $guestNote = GuestNote::create($request->all());

        return $this->jsonResponse($guestNote, 200);
    }
}
