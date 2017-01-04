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

    public function store(Request $request)
    {

    }

    public function update(Request $request, $experienceId, $skillId)
    {
        $experience = $this->experienceRepository->find($experienceId);

        $association = SkillAssociation::toSkillable($experience)->toSkill($skillId)->first();

        if (!$association) {
            return $this->skillRepository->find($skillId);
        }

        $association->fill([
            'skill_id' => $request->input('id'),
            'percentage' => $request->input('percentage')
        ])->save();

        $this->experienceRepository->forgetCache();

        return $association->skill;
    }

    public function destroy($experienceId)
    {

    }
}