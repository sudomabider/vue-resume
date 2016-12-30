<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $appends = ['percentage'];

    public function getPercentageAttribute()
    {
        if ($this->pivot) {
            return $this->pivot->percentage;
        }

        return null;
    }
}
