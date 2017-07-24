<?php

namespace App\Models\Database\User;

use App\Models\Database\Extendables\UuidModel;
use GenTux\Jwt\JwtPayloadInterface;

class User extends UuidModel implements JwtPayloadInterface{

    protected $table = 'user.users';

    protected $fillable = ['id','uuid','username','first_name','last_name','created_at','updated_at'];

    protected $hidden = ['id'];

    public function password()
    {
        return $this->hasOne(Password::class, 'user_uuid', 'uuid');
    }

    public function getPayload()
    {
        return [
            'sub' => $this->uuid,
            'exp' => time() + 7200
        ];
    }
}