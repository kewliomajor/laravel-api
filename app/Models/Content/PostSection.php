<?php

namespace App\Models\Content;

use App\Models\Extendables\UuidModel;

class PostSection extends UuidModel {

    protected $fillable = [];

    protected $hidden = ['id'];

    public function post()
    {
        return $this->hasOne('App\Models\Content\Post', 'uuid', 'post_uuid');
    }
}