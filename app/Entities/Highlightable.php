<?php
/**
 * Created by PhpStorm.
 * User: veoc
 * Date: 30/12/16
 * Time: 8:48 PM
 */

namespace App\Entities;


trait Highlightable
{
    public function highlights()
    {
        return $this->morphMany(Highlight::class, 'highlightable');
    }
}