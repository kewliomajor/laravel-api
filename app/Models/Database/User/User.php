<?php

namespace App\Models\Database\User;

use App\Models\Database\Extendables\UuidModel;

class User extends UuidModel {

    protected $table = 'user.users';

    protected $fillable = ['id','uuid','username','first_name','last_name','created_at','updated_at'];

    protected $hidden = ['id'];

    public function password()
    {
        return $this->hasOne(Password::class, 'user_uuid', 'uuid');
    }
}