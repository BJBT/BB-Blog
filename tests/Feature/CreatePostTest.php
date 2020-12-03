<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use App\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreatePostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_post_belongs_to_an_owner()
    {
        $this->withExceptionHandling();

        $post = factory(Post::class)->create();

        $this->assertInstanceOf(User::class, $post->owner);
    }

    /** @test */
    public function an_authenticated_user_can_post_a_new_post()
    {
        $this->withExceptionHandling();

        $this->signIn();

        $post = factory(Post::class)->create();

        $this->post('/posts', $post->toArray());

        $this->get('/posts')
            ->assertSee($post->title);
    }

    /** @test */
    public function an_authenticated_user_can_comment_on_a_post()
    {
        $this->withExceptionHandling();

        $this->signIn();

        $post = factory(Post::class)->create();

        $comment = factory(Comment::class)->make();

        $this->post($post->path(), $comment->toArray());

        $this->get($post->path())
            ->assertSee($comment->body);
    }

    /** @test */
    public function an_unauthenticated_user_cannot_comment_on_a_post()
    {
        $this->withExceptionHandling()
            ->post('/posts/{$this->id}', [])
            ->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_can_like_a_post()
    {
        $this->withExceptionHandling();

        $this->signIn();

        $post = factory(Post::class)->create();

        // check post is not liked by the current user
        $this->assertFalse($post->isLikedBy(auth()->user()));

        $post->like();

        // check post is liked by the current user
        $this->assertTrue($post->isLikedBy(auth()->user()));
    }
}








