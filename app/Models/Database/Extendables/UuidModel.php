<?php

namespace App\Models\Database\Extendables;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

abstract class UuidModel extends Model {

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model)
        {
            $model->generateUuid();
        });
    }

    public function generateUuid()
    {
        $this->uuid = Uuid::uuid4()->toString();
    }
}