<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use Highlightable;

    protected $appends = ['year_range', 'year_duration', 'start_year', 'end_year', 'is_single'];

    protected $dates = ['start', 'end'];

    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */

    public function getStartYearAttribute()
    {
        return $this->start->year;
    }

    public function getEndYearAttribute()
    {
        return $this->end->year;
    }

    public function getIsSingleAttribute()
    {
        return $this->getStartYearAttribute() === $this->getEndYearAttribute();
    }

    public function getYearRangeAttribute()
    {
        $start = $this->getStartYearAttribute();
        $end = $this->getEndYearAttribute();

        return $start === $end ? $start : "$start - $end";
    }

    public function getYearDurationAttribute()
    {
        return $this->start->diffInMonths($this->end)/12;
    }

    /*
    |--------------------------------------------------------------------------
    | Skills
    |--------------------------------------------------------------------------
    */

    public function skills()
    {
        return $this->belongsToMany(Skill::class)->withPivot('percentage');
    }
}
