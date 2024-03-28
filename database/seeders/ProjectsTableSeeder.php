<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("
            INSERT INTO
                `projects` (
                        `id`,
                        `type_id`,
                        `name`,
                        `slug`,
                        `cover`,
                        `hero`,
                        `url`,
                        `summary`,
                        `introduction`
                    )
            VALUES
                (
                    1,
                    1,
                    'isolved University',
                    'isolved-university',
                    '/img/projects/covers/isolved-university.webp',
                    '/img/projects/heroes/isolved-university.webp',
                    'https://learning.myisolved.com',
                    'A full-featured Learning Management System (LMS) used by over 1.5 million employees to maintain education compliance for small, medium, and enterprise businesses.',
                    '<p>Started in 2015 as an in-house knowledge base to store employee training articles for <strong>isolved</strong>, a Human Capital Management (HCM) company based in Charlotte, isolved University has become a <strong>feature-rich Learning Management System (LMS)</strong> that competes with the likes of Docebo, Moodle, and SAP Litmos.</p><p>isolved University allows employees to take <strong>e-learning standards-compliant courses</strong> in a guided system of learning paths and rewards them with certificates for their completion. The platform also features a <strong>robust gamification system</strong> that allows company administrators to control the rewards system for their own employees to earn <strong>custom points, badges, and ranks</strong>, and compete with each other for control of the company-wide leaderboard.</p><p>The LMS product offers an integration with <strong>Go1</strong>, a leading provider of e-learning standards courses based in Queensland, Australia. This Go1 integration connects employees with a library of <strong>over 100,000 e-learning courses</strong> covering everything from software training to business intelligience skills to personal life management education.</p>'
                )
            ON DUPLICATE KEY UPDATE
                `type_id` = VALUES(`type_id`),
                `name` = VALUES(`name`),
                `slug` = VALUES(`slug`),
                `cover` = VALUES(`cover`),
                `hero` = VALUES(`hero`),
                `url` = VALUES(`url`),
                `summary` = VALUES(`summary`),
                `introduction` = VALUES(`introduction`),
                `updated_at` = CURRENT_TIMESTAMP;
        ");
    }
}
