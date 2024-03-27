<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProjectController extends Controller
{
    /**
     * Fetch a JSON index of projects.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json([
            [
                'id' => 1,
                'name' => 'isolved University',
                'slug' => 'isolved-university',
                'type' => 'Web App',
                'cover' => '/img/projects/covers/isolved-university.webp',
                'hero' => '/img/projects/heroes/isolved-university.webp',
                'summary' => 'A full-featured Learning Management System (LMS) used by over 1.5 million employees to maintain education compliance for small, medium, and enterprise businesses.',
                'introduction' => '<p>Started in 2015 as an in-house knowledge base to store employee training articles for <strong>isolved</strong>, a Human Capital Management (HCM) company based in Charlotte, isolved University has become a <strong>feature-rich Learning Management System (LMS)</strong> that competes with the likes of Docebo, Moodle, and SAP Litmos.</p><p>isolved University allows employees to take <strong>e-learning standards-compliant courses</strong> in a guided system of learning paths and rewards them with certificates for their completion. The platform also features a <strong>robust gamification system</strong> that allows company administrators to control the rewards system for their own employees to earn <strong>custom points, badges, and ranks</strong>, and compete with each other for control of the company-wide leaderboard.</p><p>The LMS product offers an integration with <strong>Go1</strong>, a leading provider of e-learning standards courses based in Queensland, Australia. This Go1 integration connects employees with a library of <strong>over 100,000 e-learning courses</strong> covering everything from software training to business intelligience skills to personal life management education.</p>',
                'images' => [
                    [
                        'src' => '/img/projects/isolved-university/screenshot-homepage.png',
                        'alt' => 'isolved University Home Page',
                        'summary' => '<h2>Overview</h2><p>isolved University is a custom-built Learning Management System (LMS) that enables isolved\'s customers to control their own education and track important education-related milestones for legal compliance and employee development.</p>',
                    ],
                    [
                        'src' => '/img/projects/isolved-university/screenshot-admin-assignments.webp',
                        'alt' => 'isolved University Assignments',
                        'summary' => '<h2>Assignments</h2><p>Company administrators can send assignments to their employees and track their employees\' progress and completion status for legal compliance purposes.</p><p>Assignments can be scheduled and sent to employees based on advanced criteria such as department, work location, hire date, etc.</p>',
                    ],
                    [
                        'src' => '/img/projects/isolved-university/screenshot-admin-path.webp',
                        'alt' => 'isolved University Course Paths',
                        'summary' => '<h2>Course Paths</h2><p>Individual courses can be grouped together into collections called <strong>Paths</strong> that guide learners through related course material in order, ensuring a full understanding of complex material.</p><p>Paths allow learners to digest advanced subject matter in bite-sized pieces which enhances knowledge retention and engagement.</p>',
                    ],
                    [
                        'src' => '/img/projects/isolved-university/screenshot-admin-report.webp',
                        'alt' => 'isolved University Course Attempts Report',
                        'summary' => '<h2>Advanced Reporting</h2><p>Learner course progress can be tracked through various reports designed to empower company administrators to find detailed statistics quickly and easily.</p><p>These reports include Course Attempts, Current Course Status, At-risk Assignments, Gamification Leaderboards, and more.</p>',
                    ],
                    [
                        'src' => '/img/projects/isolved-university/screenshot-aicc-course.webp',
                        'alt' => 'isolved University e-Learning Course',
                        'summary' => '<h2>eLearning Standards Compliant</h2><p>Powered by Rustici Engine, the University handles the importing, launching, and tracking of courses in all of the world\'s major eLearning formats. These formats include SCORM 1.2, SCORM 2004, AICC, and xAPI.</p><p>In addition to the standard formats, the LMS also features multiple proprietary formats including custom video, audio, text, and presentation formats.</p><p>This variety of formats enables company administrators to control the educational experience of their employees regardless of their industry and technical needs.</p>',
                    ],
                    [
                        'src' => '/img/projects/isolved-university/screenshot-gamification.webp',
                        'alt' => 'isolved University Gamification',
                        'summary' => '<h2>Gamification</h2><p>Learners are encouraged to engage with a company\'s optional course material by way of "Gamification". This system allows learners to earn points, badges, ranks, and real-world rewards as a result of their engagement with course content.</p><p>The gamification system in the University is a custom-built solution that gives company administrators the tools to determine their own rewards and actions that result in points, badges, and ranks by defining their own "Gamification Listeners" which listen for events under the hood and then award the appropriate rewards based on user activity.</p>',
                    ],
                ],
                'technologies' => [
                    [
                        'name' => 'Laravel',
                        'purpose' => 'Back-end Framework',
                        'url' => 'https://laravel.com/',
                        'image' => '/img/technology-logos/laravel.svg',
                    ],
                    [
                        'name' => 'Vue',
                        'purpose' => 'Front-end Framework',
                        'url' => 'https://vuejs.org/',
                        'image' => '/img/technology-logos/vue.svg',
                    ],
                    [
                        'name' => 'Apache',
                        'purpose' => 'Web Server',
                        'url' => 'https://httpd.apache.org/',
                        'image' => '/img/technology-logos/apache.svg',
                    ],
                    [
                        'name' => 'MySQL',
                        'purpose' => 'Relational Database Engine',
                        'url' => 'https://www.mysql.com/',
                        'image' => '/img/technology-logos/mysql.svg',
                    ],
                    [
                        'name' => 'Redis',
                        'purpose' => 'NoSQL Database Engine',
                        'url' => 'https://redis.io/',
                        'image' => '/img/technology-logos/redis.svg',
                    ],
                    [
                        'name' => 'Phaser',
                        'purpose' => 'Game Engine',
                        'url' => 'https://phaser.io/',
                        'image' => '/img/technology-logos/phaser.webp',
                    ],
                    [
                        'name' => 'Rustici Engine',
                        'purpose' => 'eLearning Course Engine',
                        'url' => 'https://rusticisoftware.com/products/rustici-engine/',
                        'image' => '/img/technology-logos/rustici-engine.webp',
                    ],
                    [
                        'name' => 'Axios',
                        'purpose' => 'Asynchronous HTTP Client',
                        'url' => 'https://axios-http.com/',
                        'image' => '/img/technology-logos/axios.svg',
                    ],
                    [
                        'name' => 'Vite',
                        'purpose' => 'Front-end Tooling',
                        'url' => 'https://vitejs.dev/',
                        'image' => '/img/technology-logos/vite.svg',
                    ],
                    [
                        'name' => 'Vitest',
                        'purpose' => 'Front-end Testing',
                        'url' => 'https://vitest.dev/',
                        'image' => '/img/technology-logos/vitest.svg',
                    ],
                    [
                        'name' => 'Sass',
                        'purpose' => 'CSS Pre-compiler',
                        'url' => 'https://sass-lang.com/',
                        'image' => '/img/technology-logos/sass.svg',
                    ],
                    [
                        'name' => 'Node.js',
                        'purpose' => 'JavaScript Runtime',
                        'url' => 'https://nodejs.org/',
                        'image' => '/img/technology-logos/node.svg',
                    ],
                    [
                        'name' => 'NPM',
                        'purpose' => 'Front-end Package Manager',
                        'url' => 'https://www.npmjs.com/',
                        'image' => '/img/technology-logos/npm.svg',
                    ],
                    [
                        'name' => 'TinyMCE',
                        'purpose' => 'WYSIWYG Editor',
                        'url' => 'https://www.tiny.cloud/',
                        'image' => '/img/technology-logos/tinymce.svg',
                    ],
                    [
                        'name' => 'Brightcove',
                        'purpose' => 'Video Host',
                        'url' => 'https://www.brightcove.com/en/',
                        'image' => '/img/technology-logos/brightcove.svg',
                    ],
                    [
                        'name' => 'Composer',
                        'purpose' => 'Back-end Package Manager',
                        'url' => 'https://getcomposer.org/',
                        'image' => '/img/technology-logos/composer.webp',
                    ],
                    [
                        'name' => 'Docker',
                        'purpose' => 'Container Automation',
                        'url' => 'https://www.docker.com/',
                        'image' => '/img/technology-logos/docker.svg',
                    ],
                    [
                        'name' => 'PHP',
                        'purpose' => 'Back-end Scripting',
                        'url' => 'https://www.php.net/',
                        'image' => '/img/technology-logos/php.svg',
                    ],
                    [
                        'name' => 'JavaScript',
                        'purpose' => 'Front-end Scripting',
                        'url' => 'https://developer.mozilla.org/en-US/docs/Learn/JavaScript/First_steps/What_is_JavaScript',
                        'image' => '/img/technology-logos/javascript.webp',
                    ],
                    [
                        'name' => 'FFmpeg',
                        'purpose' => 'Media Encoder',
                        'url' => 'https://ffmpeg.org/',
                        'image' => '/img/technology-logos/ffmpeg.webp',
                    ],
                    [
                        'name' => 'Algolia',
                        'purpose' => 'Search Engine',
                        'url' => 'https://www.algolia.com/',
                        'image' => '/img/technology-logos/algolia.svg',
                    ],
                    [
                        'name' => 'AWS S3',
                        'purpose' => 'Cloud File Storage',
                        'url' => 'https://aws.amazon.com/s3/',
                        'image' => '/img/technology-logos/s3.svg',
                    ],
                    [
                        'name' => 'Sendgrid',
                        'purpose' => 'Email Automation',
                        'url' => 'https://sendgrid.com/',
                        'image' => '/img/technology-logos/sendgrid.svg',
                    ],
                    [
                        'name' => 'PHPUnit',
                        'purpose' => 'Back-end Testing',
                        'url' => 'https://phpunit.de/',
                        'image' => '/img/technology-logos/phpunit.svg',
                    ],
                    [
                        'name' => 'Pest',
                        'purpose' => 'Back-end Testing',
                        'url' => 'https://pestphp.com/',
                        'image' => '/img/technology-logos/pest.svg',
                    ],
                ],
            ],
            [
                'id' => 2,
                'name' => 'Example Project',
                'slug' => 'example-project',
                'type' => 'Mobile App',
                'cover' => 'https://source.unsplash.com/random/640x640',
                'hero' => 'https://source.unsplash.com/random/1920x480',
                'summary' => 'Lorem ipsum dolor sit amet, consictetur adipiscing.',
            ]
        ]);
    }
}
