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
                'summary' => 'A full-featured Learning Management System (LMS) used by over 1.25 million employees to maintain education compliance for small, medium, and enterprise businesses.',
                'introduction' => '<p>Started in 2015 as an in-house knowledge base to store employee training articles for <strong>isolved</strong>, a Human Capital Management (HCM) company based in Charlotte, isolved University has become a <strong>feature-rich LMS</strong> that competes with the likes of Docebo, Moodle, and SAP Litmos.</p><p>isolved University allows employees to take <strong>e-learning standards-compliant courses</strong> in a guided system of learning paths and rewards them with certificates for their completion. The platform also features a <strong>robust gamification system</strong> that allows company administrators to control the rewards system for their own employees to earn <strong>custom points, badges, and ranks</strong>, and compete with each other for control of the company-wide leaderboard.</p><p>The LMS product offers an integration with <strong>Go1</strong>, a leading provider of e-learning standards courses based in Queensland, Australia. This Go1 integration connects employees with a library of <strong>over 100,000 e-learning courses</strong> covering everything from software training to business intelligience skills to personal life management education.</p>',
                'images' => [
                    [
                        'src' => '/img/projects/isolved-university/screenshot-homepage.png',
                        'alt' => 'isolved University Home Page',
                        'summary' => '<h2>Home Page</h2><p>The home page for isolved University, showcasing the product\'s key features and how it can assist companies to maintain their employees\' education compliance.</p>',
                    ],
                    [
                        'src' => 'https://source.unsplash.com/random/320x320',
                        'alt' => 'Example Image',
                        'summary' => 'Lorem ipsum dolor sit amet, consictetur adipiscing.',
                    ],
                    [
                        'src' => 'https://source.unsplash.com/random/320x480',
                        'alt' => 'Example Image',
                        'summary' => 'Lorem ipsum dolor sit amet, consictetur adipiscing.',
                    ],
                    [
                        'src' => 'https://source.unsplash.com/random/1920x1080',
                        'alt' => 'Example Image',
                        'summary' => 'Lorem ipsum dolor sit amet, consictetur adipiscing.',
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
