<?php
/**
 * Created by PhpStorm.
 * User: veoc
 * Date: 30/12/16
 * Time: 6:56 PM
 */

namespace App\Http\Controllers;


use App\Entities\Experience;

class ExperienceController extends Controller
{
    public function index()
    {
        return Experience::orderBy('start', 'desc')->get();
    }

    public function show(Experience $experience)
    {
        return $experience->load('highlights', 'skills');
    }
}