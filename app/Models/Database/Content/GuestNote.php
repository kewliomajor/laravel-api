<?php

namespace App\Models\Database\Content;

use App\Models\Database\Extendables\UuidModel;
use App\Models\Database\User\User;

class GuestNote extends UuidModel {

    protected $fillable = ['uuid','author_uuid','text','created_at','updated_at'];

    protected $hidden = ['id'];

    protected $appends = ['author'];

    public function getAuthorAttribute()
    {
        $author = 'Anonymous';
        if ($this->user != null){
            $author = $this->user->first_name . ' ' . $this->user->last_name;
        }
        return $author;
    }

    public function user()
    {
        return $this->hasOne(User::class, 'uuid', 'author_uuid');
    }
}