<?php

namespace App\Providers;

use App\Entities\Project;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            'experience' => \App\Entities\Experience::class,
            'project' => \App\Entities\Project::class,
        ]);

        Project::creating(function(Project $project) {
            $max = DB::table('projects')
                ->orderBy('sort', 'desc')
                ->first(['sort'])->sort;

            $project->sort = $max + 1;
            return $project;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
