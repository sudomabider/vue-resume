<?php
/**
 * Created by PhpStorm.
 * User: veoc
 * Date: 7/01/17
 * Time: 3:05 PM
 */

namespace App\Http\Controllers;


use App\Entities\ProjectRepository;
use App\Entities\SkillAssociation;
use App\Entities\SkillRepository;
use Illuminate\Http\Request;

class ProjectSkillController
{
    /**
     * @var ProjectRepository
     */
    private $projectRepository;
    /**
     * @var SkillRepository
     */
    private $skillRepository;

    /**
     * ProjectSkillController constructor.
     * @param ProjectRepository $projectRepository
     * @param SkillRepository $skillRepository
     */
    public function __construct(ProjectRepository $projectRepository, SkillRepository $skillRepository)
    {
        $this->projectRepository = $projectRepository;
        $this->skillRepository = $skillRepository;
    }

    public function store(Request $request, $projectId)
    {
        $project = $this->projectRepository->find($projectId);

        $project->skills()->attach($request->input('id'), [
            'percentage' => $request->input('percentage')
        ]);

        $this->projectRepository->forgetCache();

        return $project->skills()->where('skill_id', $request->input('id'))->first();
    }

    public function update(Request $request, $projectId, $skillId)
    {
        $association = $this->getSkillAssociation($projectId, $skillId);

        $association->fill([
            'skill_id' => $request->input('id'),
            'percentage' => $request->input('percentage')
        ])->save();

        $this->projectRepository->forgetCache();

        return $association;
    }

    public function destroy($projectId, $skillId)
    {
        $association = $this->getSkillAssociation($projectId, $skillId);

        $association->delete();

        $this->projectRepository->forgetCache();

        return;
    }

    /**
     * @param $projectId
     * @param $skillId
     * @return mixed
     */
    protected function getSkillAssociation($projectId, $skillId)
    {
        $project = $this->projectRepository->find($projectId);

        return SkillAssociation::toSkillable($project)->toSkill($skillId)->first();
    }
}