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

$router->resource('experiences.highlights', 'ExperienceHighlightController', ['only' => ['store']]);
$router->put('highlights/{highlightId}', ['uses' => 'ExperienceHighlightController@update']);
$router->delete('highlights/{highlightId}', ['uses' => 'ExperienceHighlightController@destroy']);

$router->resource('projects', 'ProjectController');
$router->post('projects/reorder', ['uses' => 'ProjectController@reorder']);
$router->resource('projects.skills', 'ProjectSkillController');

$router->resource('projects.highlights', 'ProjectHighlightController', ['only' => ['store']]);
$router->put('highlights/{highlightId}', ['uses' => 'ProjectHighlightController@update']);
$router->delete('highlights/{highlightId}', ['uses' => 'ProjectHighlightController@destroy']);

$router->resource('skills', 'SkillController');

$router->post('contact', ['uses' => 'ContactController@post']);

$router->post('login', ['uses' => 'AuthController@authenticate']);
$router->get('me', ['uses' => 'AuthController@getUser']);