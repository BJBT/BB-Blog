<?php

namespace Tests\Feature;

use App\Comment;
use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReadPostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_see_community_post()
    {
        $this->withExceptionHandling();

        $post = factory(Post::class)->create();

        $this->get('/posts')
            ->assertSee($post->title);
    }

    /** @test */
    public function a_user_can_see_a_single_post()
    {
        $this->withExceptionHandling();

        $post = factory(Post::class)->create();

        $this->get('/posts/' . $post->id)
            ->assertSee($post->title)
            ->assertSee($post->body);
    }

    /** @test */
    public function a_user_can_view_comments_that_belong_to_a_blog_post()
    {
        $this->withExceptionHandling();

        $post = factory(Post::class)->create();

        $comment = factory(Comment::class)->create(['post_id' => $post->id]);

        $this->get('/posts/' . $post->id)
            ->assertSee($comment->body);
    }

    /** @test */
    public function an_authenticated_user_can_view_their_own_posts()
    {
        $this->withExceptionHandling();

        $this->signIn();

        $post = factory(Post::class)->create();

        $this->post('/posts', $post->toArray());

        $this->get('personal')
            ->assertSee($post->title);
    }
}
