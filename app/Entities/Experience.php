<?php

namespace App\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use Highlightable, Skillable;

    protected $fillable = ['employer', 'title', 'start', 'end', 'type'];

    protected $appends = ['year_range', 'duration', 'start_year', 'end_year', 'is_single'];

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
        return $this->end ? $this->end->year : Carbon::today()->year;
    }

    public function getIsSingleAttribute()
    {
        return $this->getStartYearAttribute() === $this->getEndYearAttribute();
    }

    public function getYearRangeAttribute()
    {
        $start = $this->getStartYearAttribute();
        $end = $this->end ? $this->end->year : 'Present';

        return $this->getIsSingleAttribute() ? $start : "$start - $end";
    }

    public function getDurationAttribute()
    {
        return $this->start->diffInMonths($this->end);
    }
}
