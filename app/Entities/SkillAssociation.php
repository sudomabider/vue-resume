<?php
/**
 * Created by PhpStorm.
 * User: veoc
 * Date: 4/01/17
 * Time: 10:42 AM
 */

namespace App\Entities;


use Illuminate\Database\Eloquent\Model;

class SkillAssociation extends Model
{
    protected $table = 'has_skills';

    protected $fillable = ['id', 'skill_id', 'percentage'];

    public function skillable()
    {
        return $this->morphTo('skillable');
    }

    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }

    public function scopeToSkillable($query, Model $skillable)
    {
        $query->where([
            ['skillable_type', '=', $skillable->getMorphClass()],
            ['skillable_id', '=', $skillable->id]
        ]);
    }

    public function scopeToSkill($query, $skill)
    {
        $query->where('skill_id', $skill instanceof Skill ? $skill->id : $skill);
    }
}