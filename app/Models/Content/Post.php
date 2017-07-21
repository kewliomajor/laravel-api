<?php

namespace App\Models\Content;

use App\Models\Extendables\UuidModel;

class Post extends UuidModel {

    protected $fillable = [];

    protected $hidden = ['id'];

    public function postSections()
    {
        return $this->hasMany('App\Models\Content\PostSection', 'post_uuid', 'uuid')->orderBy('order', 'desc');
    }
}