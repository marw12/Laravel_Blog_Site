<?php

namespace Tests\Feature;

use App\BlogPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function testNoBlogPostsYet()
    {
        $response = $this->get('/post');
        $response->assertSeeText('No Blog Posts Yet!');
    }

    public function testOneBlogPostPostedShows(){

        //Arrange
        $post = new BlogPost();
        $post->title = 'New Title';
        $post->content = 'Some contact';
        $post->save();  

        //Act
        $response = $this->get('/post');

        //Assert
        $response->assertSeeText('New Title');

        $this->assertDatabaseHas('blog_posts', [

            'title' => 'New Title'
            
        ]);
        
    }

    public function testStoreValid(){

        $params = [
            'title' => 'New Title',
            'content' => 'Some content'
        ];

        $this->post('/post', $params)->assertStatus(302);
    }

    public function testStoreFails(){

        $params = [
            'title' => 'x',
            'content' => 'x'
        ];

        $this->post('/post', $params)->assertStatus(302)->assertSessionHas('errors');

        $messages = session('errors')->getMessages();

        $this->assertEquals($messages['title'][0], "The title must be at least 5 characters.");
        $this->assertEquals($messages['content'][0], "The content must be at least 10 characters.");

        
    }

    public function testUpdateWorking(){

        $post = new BlogPost();
        $post->id = '1';
        $post->title = 'New Title';
        $post->content = 'Some contact';
        $post->save();  

        $this->assertDatabaseHas('blog_posts', [
            'title' => 'New Title',
        ]);

        $params = [
            'title' => 'Marie Day',
            'content' => 'Is very skimpy teacher'
        ];

        //we are using PUT HTTP request instead of POST
        $this->put('/post/{$post->id}', $params)->assertStatus(302);
    }
}
