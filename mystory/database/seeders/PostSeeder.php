<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::create([
            'uid' => 1,
            'title' => 'My first post',
            'content' => 'this is my first post on mystorymeb',
            'image' => 'https://static.remove.bg/sample-gallery/graphics/bird-thumbnail.jpg',
        ]);

        Post::create([
            'uid' => 1,
            'title' => 'My second post',
            'content' => 'Hi, how are you, i am still good!',
            'image' => 'https://pixlr.com/images/index/ai-image-generator-one.webp',
        ]);

        Post::create([
            'uid' => 2,
            'title' => '1st post',
            'content' => 'Hello, how are you, i am Trang',
            'image' => 'https://pixlr.com/images/index/ai-image-generator-one.webp',
        ]);

        Post::create([
            'uid' => 3,
            'title' => 'about me',
            'content' => 'Hello, I am Linh',
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTeXD6dCSRGr2xAWV2Tp8MsqXPJm6-ffu0SRvLDNRMd0G9aDH5Onxdh5EUuopyuFPIG-Zk&usqp=CAU',
        ]);

    }
}
