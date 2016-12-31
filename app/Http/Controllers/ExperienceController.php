<?php
/**
 * Created by PhpStorm.
 * User: veoc
 * Date: 30/12/16
 * Time: 6:56 PM
 */

namespace App\Http\Controllers;


use App\Entities\ExperienceRepository;
use Carbon\Carbon;

class ExperienceController extends Controller
{
    /**
     * @var ExperienceRepository
     */
    private $experienceRepository;

    /**
     * ExperienceController constructor.
     * @param ExperienceRepository $experienceRepository
     */
    public function __construct(ExperienceRepository $experienceRepository)
    {
        $this->experienceRepository = $experienceRepository;
    }

    public function index()
    {
        $experiences = $this->experienceRepository->orderBy('start', 'desc')->findAll();

        $first = $this->experienceRepository->orderBy('start', 'asc')->limit(1)->findAll()->first();
        $last = $this->experienceRepository->orderBy('start', 'desc')->limit(1)->findAll()->first();

        $startDate = $first->start;
        $endDate = $last->end ? : Carbon::today();

        $duration = $startDate->diffInMonths($endDate);

        $experiences = $experiences->map(function($experience) use ($startDate) {
            $experience->left = $experience->start->diffInMonths($startDate);
            return $experience;
        });

        return collect([
            'experiences' => $experiences,
            'duration' => $duration
        ]);
    }

    public function show($experienceId)
    {
        return $this->experienceRepository->with(['highlights', 'skills'])->find($experienceId);
    }
}