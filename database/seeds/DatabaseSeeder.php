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
        // $this->call(UsersTableSeeder::class);

        $experiences = factory(\App\Entities\Experience::class, 5)->create();

        $experiences->each(function(\App\Entities\Experience $experience){
            $experience->highlights()->saveMany(
                factory(\App\Entities\Highlight::class, 5)->make()
            );
        });

        $skills = factory(\App\Entities\Skill::class, 6)->create();

        $experiences->each(function(\App\Entities\Experience $experience) use ($skills) {
            $skills = $skills->random(rand(2,5));
            foreach ($skills as $skill) {
                $experience->skills()->attach($skill->id, ['percentage' => $this->faker->randomNumber(2)]);
            }
        });
    }
}
