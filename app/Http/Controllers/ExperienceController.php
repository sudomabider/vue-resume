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
        return Experience::orderBy('start', 'desc')->with('highlights', 'skills')->get();
    }
}