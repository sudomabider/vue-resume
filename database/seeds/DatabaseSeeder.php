<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * @var \Faker\Generator
     */
    private $faker;

    /**
     * DatabaseSeeder constructor.
     * @param \Faker\Generator $faker
     */
    public function __construct(\Faker\Generator $faker)
    {
        $this->faker = $faker;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* USER */
        if (config('resume.user.email') AND config('resume.user.password')) {
            factory(\App\Entities\User::class)->create([
                'name' => config('resume.user.name'),
                'email' => config('resume.user.email'),
                'password' => bcrypt(config('resume.user.password'))
            ]);
        }

        /* SKILLS */
        $skills = factory(\App\Entities\Skill::class, 10)->create();

        /* EXPERIENCES */
        $experiences = factory(\App\Entities\Experience::class, 5)->create();
        $experiences->each(function($experience) use ($skills) {
            $experience->highlights()->saveMany(factory(\App\Entities\Highlight::class, 5)->make());
            
            $skills = $skills->random(mt_rand(3,5));
            foreach ($skills as $skill) {
                $experience->skills()->attach($skill->id, ['percentage' => $this->faker->randomNumber(2)]);
            }
        });

        /* EDUCATION */
        factory(\App\Entities\Experience::class, 3)->states(['study'])->create();

        /* PROJECTS */
        $projects = factory(\App\Entities\Project::class, 5)->create();
        $projects->each(function($project) use ($skills) {
            $project->highlights()->saveMany(factory(\App\Entities\Highlight::class, 5)->make());

            $skills = $skills->random(mt_rand(3,5));
            foreach ($skills as $skill) {
                $project->skills()->attach($skill->id, ['percentage' => $this->faker->randomNumber(2)]);
            }
        });
    }
}
