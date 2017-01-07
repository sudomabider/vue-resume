<?php
/**
 * Created by PhpStorm.
 * User: veoc
 * Date: 1/01/17
 * Time: 1:26 PM
 */

namespace App\Http\Controllers;


use App\Entities\ProjectRepository;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * @var ProjectRepository
     */
    private $projectRepository;

    /**
     * ProjectController constructor.
     * @param ProjectRepository $projectRepository
     */
    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
        $this->middleware('jwt.auth')->only('store', 'update', 'reorder');
    }

    public function index()
    {
        return $this->projectRepository->orderBy('sort', 'asc')->findAll();
    }

    public function show($projectId)
    {
        return $this->projectRepository->with(['highlights', 'skills'])->find($projectId);
    }

    public function store(Request $request)
    {
        list($created, $project) = $this->projectRepository->create($request->all());

        return $project;
    }

    public function update(Request $request, $projectId)
    {
        list($updated, $project) = $this->projectRepository->update($projectId, $request->all());

        return $project;
    }

    public function reorder(Request $request)
    {
        $order = $request->input('order');

        foreach ($order as $project => $sort) {
            $this->projectRepository->update($project, [
                'sort' => $sort
            ]);
        }
    }
}