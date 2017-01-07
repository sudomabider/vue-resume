<?php
/**
 * Created by PhpStorm.
 * User: veoc
 * Date: 4/01/17
 * Time: 9:15 AM
 */

namespace App\Http\Controllers;


use App\Entities\HighlightRepository;
use App\Entities\ProjectRepository;
use Illuminate\Http\Request;

class ProjectHighlightController extends Controller
{
    /**
     * @var HighlightRepository
     */
    private $highlightRepository;
    /**
     * @var ProjectRepository
     */
    private $projectRepository;

    /**
     * ProjectHighlightController constructor.
     * @param HighlightRepository $highlightRepository
     * @param ProjectRepository $projectRepository
     */
    public function __construct(HighlightRepository $highlightRepository, ProjectRepository $projectRepository)
    {
        $this->highlightRepository = $highlightRepository;
        $this->projectRepository = $projectRepository;
    }

    public function store(Request $request, $projectId)
    {
        $project = $this->projectRepository->find($projectId);

        $highlight = $project->highlights()->create([
            'content' => $request->input('content')
        ]);

        $this->projectRepository->forgetCache();

        return $highlight;
    }

    public function update(Request $request, $highlightId)
    {
        $this->highlightRepository->update($highlightId, $request->all());

        $this->projectRepository->forgetCache();

        return;
    }

    public function destroy($highlightId)
    {
        $this->highlightRepository->delete($highlightId);

        $this->projectRepository->forgetCache();

        return;
    }
}