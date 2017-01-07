<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Highlight extends Model
{
    protected $fillable = ['content'];

    public function highlightable()
    {
        return $this->morphTo('highlightable');
    }
}
