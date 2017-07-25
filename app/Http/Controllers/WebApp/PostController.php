<?php

namespace App\Http\Controllers\WebApp;

use App\Http\Controllers\Extendables\BaseController;
use App\Models\Database\Content\Post;

class PostController extends BaseController
{

    /*
     * GET resource
     */
    public function index()
    {
        return $this->jsonResponse(Post::with("postSections")->orderBy('created_at', 'desc')->get(), 200);
    }
}
