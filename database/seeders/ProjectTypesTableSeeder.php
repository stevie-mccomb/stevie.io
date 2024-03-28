<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectTypesTableSeeder extends Seeder
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
                `project_types` (`id`, `name`, `slug`, `icon`)
            VALUES
                (1, 'Web App', 'web-app', 'fa-code-fork'),
                (2, 'Website', 'website', 'fa-desktop'),
                (3, 'Mobile App', 'mobile-app', 'fa-mobile'),
                (4, 'Video Game', 'video-game', 'fa-gamepad')
            ON DUPLICATE KEY UPDATE
                `name` = VALUES(`name`),
                `slug` = VALUES(`slug`),
                `icon` = VALUES(`icon`),
                `updated_at` = CURRENT_TIMESTAMP;
        ");
    }
}
