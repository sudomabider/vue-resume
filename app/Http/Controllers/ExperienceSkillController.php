<?php
/**
 * Created by PhpStorm.
 * User: veoc
 * Date: 4/01/17
 * Time: 9:12 AM
 */

namespace App\Http\Controllers;


use App\Entities\ExperienceRepository;
use App\Entities\SkillAssociation;
use App\Entities\SkillRepository;
use Illuminate\Http\Request;

class ExperienceSkillController extends Controller
{
    /**
     * @var ExperienceRepository
     */
    private $experienceRepository;
    /**
     * @var SkillRepository
     */
    private $skillRepository;

    /**
     * ExperienceSkillController constructor.
     * @param ExperienceRepository $experienceRepository
     * @param SkillRepository $skillRepository
     */
    public function __construct(ExperienceRepository $experienceRepository, SkillRepository $skillRepository)
    {
        $this->experienceRepository = $experienceRepository;
        $this->skillRepository = $skillRepository;
    }

    public function store(Request $request, $experienceId)
    {
        $experience = $this->experienceRepository->find($experienceId);

        $experience->skills()->attach($request->input('id'), [
            'percentage' => $request->input('percentage')
        ]);

        $this->experienceRepository->forgetCache();

        return $experience->skills()->where('skill_id', $request->input('id'))->first();
    }

    public function update(Request $request, $experienceId, $skillId)
    {
        $association = $this->getSkillAssociation($experienceId, $skillId);

        $association->fill([
            'skill_id' => $request->input('id'),
            'percentage' => $request->input('percentage')
        ])->save();

        $this->experienceRepository->forgetCache();

        return $association;
    }

    public function destroy($experienceId, $skillId)
    {
        $association = $this->getSkillAssociation($experienceId, $skillId);

        $association->delete();

        $this->experienceRepository->forgetCache();

        return;
    }

    /**
     * @param $experienceId
     * @param $skillId
     * @return mixed
     */
    protected function getSkillAssociation($experienceId, $skillId)
    {
        $experience = $this->experienceRepository->find($experienceId);

        return SkillAssociation::toSkillable($experience)->toSkill($skillId)->first();
    }
}