<?php

use App\Comment;
use App\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(Post::class, 20)->create();
        factory(Comment::class, 20)->create();

    }
}
