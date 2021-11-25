<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Models\Comment;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_index_page_load()
    {
        $this->withoutExceptionHandling();

        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /** @test */
    public function test_comment_create() {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/comments', [
            'name' => 'Amir Hosseinzadeh',
            'comment' => 'Test Unit Comment'
        ]);

        $response->assertOk();
        $this->assertCount(1, Comment::all());
    }

    /** @test */
    public function test_comment_form_validation() {
        // $this->withoutExceptionHandling();

        $response = $this->post('/api/comments', [
            'name' => '',
            'comment' => 'Test Unit Comment'
        ]);

        $response->assertSessionHasErrors('name');

        $response = $this->post('/api/comments', [
            'name' => 'Amir Hosseinzadeh',
            'comment' => ''
        ]);

        $response->assertSessionHasErrors('comment');
    }

    /** @test */
    public function test_comment_listing_returns() {
        $this->test_comment_create();

        $response = $this->get('/api/comments');

        $response->assertOk();

        $this->assertDatabaseHas('comments', [
            'name' => 'Amir Hosseinzadeh'
        ]);
    }
}
