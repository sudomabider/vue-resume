<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name', 'source', 'url', 'sort'];

    use Highlightable, Skillable;
}
