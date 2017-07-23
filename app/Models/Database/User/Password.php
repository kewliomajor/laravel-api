<?php

namespace App\Models\Database\User;

use App\Models\Database\Extendables\UuidModel;

class Password extends UuidModel {

    protected $table = 'user.passwords';

    protected $fillable = ['id','uuid','user_uuid','password'];

    protected $hidden = ['id','password'];

    public function user()
    {
        return $this->hasOne(User::class, 'uuid', 'user_uuid');
    }
}