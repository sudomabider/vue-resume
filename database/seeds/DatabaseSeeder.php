<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * @var \Faker\Generator
     */
    private $faker;

    private $skills = [
        [
            'id' => 1,
            'name' => 'Laravel',
            'color' => '#f4645f'
        ], [
            'id' => 2,
            'name' => 'Apache',
            'color' => '#557697'
        ], [
            'id' => 3,
            'name' => 'Java',
            'color' => '#ff0000'
        ], [
            'id' => 4,
            'name' => 'CSS',
            'color' => '#80ff80'
        ], [
            'id' => 5,
            'name' => 'Bootstrap',
            'color' => '#6f5499'
        ], [
            'id' => 6,
            'name' => 'Javascript',
            'color' => '#F0DB4F'
        ], [
            'id' => 7,
            'name' => 'ReactJS',
            'color' => '#61dafb'
        ], [
            'id' => 8,
            'name' => 'VueJS',
            'color' => '#4fc08d'
        ], [
            'id' => 9,
            'name' => 'MySQL',
            'color' => '#3e78a6'
        ], [
            'id' => 10,
            'name' => 'Semantic UI',
            'color' => '#00B5AD'
        ]
    ];

    private $experiences = [
        [
            'employer' => 'SLI Systems',
            'title' => 'Software Engineer',
            'start' => '2013-01-01',
            'end' => '2015-06-01',
            'type' => 'work',
            'skills' => [
                2 => 20,
                3 => 10,
                4 => 30,
                6 => 40
            ],
            'highlights' => [
                'Developing and maintaining search apps for hundreds of clients',
                'Adapting and debugging hundreds of different web implementations',
                'Strong emphasis on frontend web technologies and standards',
                'Writing and maintaining search instances using Perl and Java',
                'Closely working with Solr-based proprietary search engine'
            ],
        ], [
            'employer' => 'Gez Studio',
            'title' => 'Web Developer',
            'start' => '2015-06-01',
            'end' => null,
            'type' => 'work',
            'skills' => [
                1 => 40,
                5 => 30,
                6 => 20,
                9 => 10
            ],
            'highlights' => [
                'Designing and developing a full fledged multi-vendor trading platform using Laravel',
                'Designing and developing multiple CMS and blog sites',
                'Various open source packages and side projects'
            ]
        ], [
            'employer' => 'University of Auckland',
            'title' => 'Graduate Diploma in Software Engineering',
            'start' => '2012-02-01',
            'end' => '2012-11-01',
            'type' => 'study',
            'highlights' => [],
            'skills' => []
        ], [
            'employer' => 'University of Cambridge',
            'title' => 'BA + MA in Information and Computer Engineering',
            'start' => '2007-10-1',
            'end' => '2011-06-01',
            'type' => 'study',
            'highlights' => [],
            'skills' => []
        ]
    ];

    private $projects = [
        [
            'name' => 'gez-studio/gez-market',
            'source' => 'https://github.com/gez-studio/gez-market',
            'url' => 'http://market.gez.co.nz',
            'sort' => 1,
            'skills' => [
                1 => 30,
                3 => 20,
                5 => 20,
                6 => 20,
                9 => 10
            ],
            'highlights' => [
                'E-Commerce platform supporting multiple individual vendors and shops',
                'Fully responsive frontend built with Bootstrap, jQuery and VueJS',
                'Full fledged system with Redis caching and session, Beanstalk queue, automated deployment and multiple 3rd party service integrations',
            ]
        ], [
            'name' => 'sudomabider/bushimen-2.0',
            'source' => 'https://github.com/sudomabider/bushimen-2.0',
            'url' => 'https://bushimen.com',
            'sort' => 2,
            'skills' => [
                1 => 60,
                9 => 10,
                10 => 30
            ],
            'highlights' => [
                'Full fledged CMS system built with Laravel and Semantic UI',
                'Custom made markdown extensions to integrate with Semantic UI',
                'Complete data migration from old database to new schema'
            ]
        ], [
            'name' => 'sudomabider/vue-resume',
            'source' => 'https://github.com/sudomabider/vue-resume',
            'url' => 'http://resume.veoveo.me',
            'sort' => 3,
            'skills' => [
                1 => 40,
                5 => 10,
                8 => 50
            ],
            'highlights' => [
                'Full single page app built with VueJS, and Laravel as API',
                'Easy content management through admin panel',
                'You\'re looking at it right now!',
            ]
        ]
    ];

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
        /* SKILLS */

        foreach ($this->skills as $skill) {
            \App\Entities\Skill::create($skill);
        }

        /* EXPERIENCES */

        foreach ($this->experiences as $experience) {
            $instance = \App\Entities\Experience::create(\Illuminate\Support\Arr::only($experience, ['employer','title','start','end', 'type']));

            // Highlights
            foreach ($experience['highlights'] as $highlight) {
                $instance->highlights()->save(new \App\Entities\Highlight(['content' => $highlight]));
            }

            // Skills
            foreach ($experience['skills'] as $id => $skill) {
                $instance->skills()->attach($id, ['percentage' => $skill]);
            }
        }

        /* PROJECTS */
        foreach ($this->projects as $project) {
            $instance = \App\Entities\Project::create(\Illuminate\Support\Arr::only($project, ['name', 'source', 'url', 'sort']));

            // Highlights
            foreach ($project['highlights'] as $highlight) {
                $instance->highlights()->save(new \App\Entities\Highlight(['content' => $highlight]));
            }

            // Skills
            foreach ($project['skills'] as $id => $skill) {
                $instance->skills()->attach($id, ['percentage' => $skill]);
            }
        }
    }
}
