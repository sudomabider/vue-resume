<?php
/**
 * Created by PhpStorm.
 * User: veoc
 * Date: 3/01/17
 * Time: 6:25 PM
 */

namespace App\Http\Controllers;


use App\Entities\SkillRepository;

class SkillController extends Controller
{
    /**
     * @var SkillRepository
     */
    private $skillRepository;

    /**
     * SkillController constructor.
     * @param SkillRepository $skillRepository
     */
    public function __construct(SkillRepository $skillRepository)
    {
        $this->skillRepository = $skillRepository;
    }

    public function index()
    {
        return $this->skillRepository->findAll();
    }
}