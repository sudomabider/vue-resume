<?php
/**
 * Created by PhpStorm.
 * User: veoc
 * Date: 1/01/17
 * Time: 1:45 PM
 */

namespace App\Entities;


use Rinvex\Repository\Repositories\EloquentRepository;

class ProjectRepository extends EloquentRepository
{
    protected $model = Project::class;
}