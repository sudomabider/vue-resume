<?php
/**
 * Created by PhpStorm.
 * User: veoc
 * Date: 1/01/17
 * Time: 1:22 PM
 */

namespace App\Entities;


trait Skillable
{
    public function skills()
    {
        return $this->morphToMany(Skill::class, 'skillable', 'has_skills')->withPivot('percentage');
    }
}