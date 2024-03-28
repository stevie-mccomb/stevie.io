<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TechnologiesTableSeeder extends Seeder
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
                `technologies` (`name`, `url`, `purpose`, `image`)
            VALUES
                (
                    'Laravel',
                    'Back-end Framework',
                    'https://laravel.com/',
                    '/img/technology-logos/laravel.svg'
                ),
                (
                    'Vue',
                    'Front-end Framework',
                    'https://vuejs.org/',
                    '/img/technology-logos/vue.svg'
                ),
                (
                    'Apache',
                    'Web Server',
                    'https://httpd.apache.org/',
                    '/img/technology-logos/apache.svg'
                ),
                (
                    'MySQL',
                    'Relational Database Engine',
                    'https://www.mysql.com/',
                    '/img/technology-logos/mysql.svg'
                ),
                (
                    'Redis',
                    'NoSQL Database Engine',
                    'https://redis.io/',
                    '/img/technology-logos/redis.svg'
                ),
                (
                    'Phaser',
                    'Game Engine',
                    'https://phaser.io/',
                    '/img/technology-logos/phaser.webp'
                ),
                (
                    'Rustici Engine',
                    'eLearning Course Engine',
                    'https://rusticisoftware.com/products/rustici-engine/',
                    '/img/technology-logos/rustici-engine.webp'
                ),
                (
                    'Axios',
                    'Asynchronous HTTP Client',
                    'https://axios-http.com/',
                    '/img/technology-logos/axios.svg'
                ),
                (
                    'Vite',
                    'Front-end Tooling',
                    'https://vitejs.dev/',
                    '/img/technology-logos/vite.svg'
                ),
                (
                    'Vitest',
                    'Front-end Testing',
                    'https://vitest.dev/',
                    '/img/technology-logos/vitest.svg'
                ),
                (
                    'Sass',
                    'CSS Pre-compiler',
                    'https://sass-lang.com/',
                    '/img/technology-logos/sass.svg'
                ),
                (
                    'Node.js',
                    'JavaScript Runtime',
                    'https://nodejs.org/',
                    '/img/technology-logos/node.svg'
                ),
                (
                    'NPM',
                    'Front-end Package Manager',
                    'https://www.npmjs.com/',
                    '/img/technology-logos/npm.svg'
                ),
                (
                    'TinyMCE',
                    'WYSIWYG Editor',
                    'https://www.tiny.cloud/',
                    '/img/technology-logos/tinymce.svg'
                ),
                (
                    'Brightcove',
                    'Video Host',
                    'https://www.brightcove.com/en/',
                    '/img/technology-logos/brightcove.svg'
                ),
                (
                    'Composer',
                    'Back-end Package Manager',
                    'https://getcomposer.org/',
                    '/img/technology-logos/composer.webp'
                ),
                (
                    'Docker',
                    'Container Automation',
                    'https://www.docker.com/',
                    '/img/technology-logos/docker.svg'
                ),
                (
                    'PHP',
                    'Back-end Scripting',
                    'https://www.php.net/',
                    '/img/technology-logos/php.svg'
                ),
                (
                    'JavaScript',
                    'Front-end Scripting',
                    'https://developer.mozilla.org/en-US/docs/Learn/JavaScript/First_steps/What_is_JavaScript',
                    '/img/technology-logos/javascript.webp'
                ),
                (
                    'FFmpeg',
                    'Media Encoder',
                    'https://ffmpeg.org/',
                    '/img/technology-logos/ffmpeg.webp'
                ),
                (
                    'Algolia',
                    'Search Engine',
                    'https://www.algolia.com/',
                    '/img/technology-logos/algolia.svg'
                ),
                (
                    'AWS S3',
                    'Cloud File Storage',
                    'https://aws.amazon.com/s3/',
                    '/img/technology-logos/s3.svg'
                ),
                (
                    'Sendgrid',
                    'Email Automation',
                    'https://sendgrid.com/',
                    '/img/technology-logos/sendgrid.svg'
                ),
                (
                    'PHPUnit',
                    'Back-end Testing',
                    'https://phpunit.de/',
                    '/img/technology-logos/phpunit.svg'
                ),
                (
                    'Pest',
                    'Back-end Testing',
                    'https://pestphp.com/',
                    '/img/technology-logos/pest.svg'
                )
            ON DUPLICATE KEY UPDATE
                `name` = VALUES(`name`),
                `purpose` = VALUES(`purpose`),
                `url` = VALUES(`url`),
                `image` = VALUES(`image`),
                `updated_at` = CURRENT_TIMESTAMP;
        ");
    }
}
