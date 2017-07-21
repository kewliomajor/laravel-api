<?php

namespace App\Http\Controllers\WebApp;

use App\Http\Controllers\Extendables\BaseController;
use App\Models\Content\Post;

class PostController extends BaseController
{

    /*
     * GET resource
     */
    public function index()
    {
        return $this->jsonResponse(Post::with("postSections")->get(), 200);
    }
}