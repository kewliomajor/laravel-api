<?php

namespace App\Http\Controllers\WebApp;

use App\Http\Controllers\Extendables\BaseController;
use App\Models\Database\Content\GuestNote;

class GuestbookController extends BaseController
{

    /*
     * GET resource
     */
    public function index()
    {
        return $this->jsonResponse(GuestNote::orderBy('created_at', 'desc')->get(), 200);
    }
}
