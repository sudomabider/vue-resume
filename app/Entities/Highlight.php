<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Highlight extends Model
{
    public function highlightable()
    {
        return $this->morphTo('highlightable');
    }
}
