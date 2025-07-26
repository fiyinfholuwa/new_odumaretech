<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AchievementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
  
    public function run()
{
    $achievements = [
        [
            'code'=> 'first_course',
            'title' => 'First Course Completed',
            'description' => 'Completed your first course',
            'color' => 'primary',
            'icon' => 'graduation-cap',
            'points' => 100,
            'target' => 1
        ],
        [
            'code'=>'code_expert',
            'title' => 'Coding Expert',
            'description' => 'Completed 5 programming courses',
            'color' => 'warning',
            'icon' => 'code',
            'points' => 500,
            'target' => 5
        ],
        [
            'code' => 'persistent',
            'title' => 'Persistent Learner',
            'description' => 'Logged in for 30 consecutive days',
            'color' => 'primary',
            'icon' => 'calendar-check',
            'points' => 300,
            'target' => 30
        ],
        [
            'code' => 'seeker',
            'title' => 'Knowledge Seeker',
            'description' => 'Complete 10 different courses',
            'color' => 'info',
            'icon' => 'book',
            'points' => 750,
            'target' => 10
        ],
        [

            'code' => 'speed',
            'title' => 'Speed Demon',
            'description' => 'Complete a course in under 24 hours',
            'color' => 'danger',
            'icon' => 'lightning-bolt',
            'points' => 200,
            'target' => 1
        ]
    ];

    foreach ($achievements as $achievement) {
        \App\Models\Achievement::create($achievement);
    }
}

}
