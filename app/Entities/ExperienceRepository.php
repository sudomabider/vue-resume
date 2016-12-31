<?php
/**
 * Created by PhpStorm.
 * User: veoc
 * Date: 1/01/17
 * Time: 9:28 AM
 */

namespace App\Entities;


use Rinvex\Repository\Repositories\EloquentRepository;

class ExperienceRepository extends EloquentRepository
{
    protected $model = Experience::class;
}