<?php

namespace App\Models\Database\Content;

use App\Models\Database\Extendables\UuidModel;

class Post extends UuidModel {

    protected $fillable = [];

    protected $hidden = ['id'];

    public function postSections()
    {
        return $this->hasMany(PostSection::class, 'post_uuid', 'uuid')->orderBy('order', 'asc');
    }
}