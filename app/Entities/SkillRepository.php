<?php
/**
 * Created by PhpStorm.
 * User: veoc
 * Date: 3/01/17
 * Time: 6:24 PM
 */

namespace App\Entities;


use Rinvex\Repository\Repositories\EloquentRepository;

class SkillRepository extends EloquentRepository
{
    protected $model = Skill::class;
}