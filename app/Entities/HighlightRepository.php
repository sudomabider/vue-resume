<?php
/**
 * Created by PhpStorm.
 * User: veoc
 * Date: 7/01/17
 * Time: 2:02 PM
 */

namespace App\Entities;


use Rinvex\Repository\Repositories\EloquentRepository;

class HighlightRepository extends EloquentRepository
{
    protected $model = Highlight::class;
}