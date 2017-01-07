<?php
/**
 * Created by PhpStorm.
 * User: veoc
 * Date: 4/01/17
 * Time: 9:13 AM
 */

namespace App\Http\Controllers;


use App\Entities\ExperienceRepository;
use App\Entities\HighlightRepository;
use Illuminate\Http\Request;

class ExperienceHighlightController extends Controller
{
    /**
     * @var HighlightRepository
     */
    private $highlightRepository;
    /**
     * @var ExperienceRepository
     */
    private $experienceRepository;

    /**
     * ExperienceHighlightController constructor.
     * @param HighlightRepository $highlightRepository
     * @param ExperienceRepository $experienceRepository
     */
    public function __construct(HighlightRepository $highlightRepository, ExperienceRepository $experienceRepository)
    {
        $this->highlightRepository = $highlightRepository;
        $this->experienceRepository = $experienceRepository;
    }

    public function store(Request $request, $experienceId)
    {
        $experience = $this->experienceRepository->find($experienceId);

        $highlight = $experience->highlights()->create([
            'content' => $request->input('content')
        ]);

        $this->experienceRepository->forgetCache();

        return $highlight;
    }

    public function update(Request $request, $highlightId)
    {
        $this->highlightRepository->update($highlightId, $request->all());

        $this->experienceRepository->forgetCache();

        return;
    }

    public function destroy($highlightId)
    {
        $this->highlightRepository->delete($highlightId);

        $this->experienceRepository->forgetCache();

        return;
    }
}