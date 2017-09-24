<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    //
    protected $table = 'author';

    public function income()
    {
        return $this->hasOne(Income::class);
    }

    public function assistant()
    {
        return $this->hasMany(Assistant::class);
    }
}
