<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$router = app(\Illuminate\Routing\Router::class);

$router->resource('experiences', 'ExperienceController');
$router->resource('experiences.skills', 'ExperienceSkillController');
$router->resource('experiences.highlights', 'ExperienceHighlightController');

$router->resource('projects', 'ProjectController');
$router->resource('projects.highlights', 'ProjectHighlightController');

$router->resource('skills', 'SkillController');

$router->post('contact', ['uses' => 'ContactController@post']);

$router->post('login', ['uses' => 'AuthController@authenticate']);
$router->get('me', ['uses' => 'AuthController@getUser']);