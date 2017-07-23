<?php

namespace App\Models\Database\Content;

use App\Models\Database\Extendables\UuidModel;

class PostSection extends UuidModel {

    protected $fillable = [];

    protected $hidden = ['id'];

    public function post()
    {
        return $this->hasOne(Post::class, 'uuid', 'post_uuid');
    }
}