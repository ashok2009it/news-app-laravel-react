<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleApiTest extends TestCase
{
    use RefreshDatabase;

    public function testArticlesAreListedCorrectly()
    {
        Article::factory()->count(1)->create();

        $response = $this->json('GET', '/api/articles');

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'title',
                        'author',
                        'description',
                        'source_name',
                        'source_url',
                        'image_url',
                        'published_at',
                    ]
                ],
                'links'
            ])
            ->assertJsonCount(1, 'data'); // Assuming the pagination is set to 10, but only 1 article is created
    }

    public function testArticlesCanBeSearched()
    {
        $article = Article::factory()->create([
            'title' => 'Unique title for search'
        ]);

        $response = $this->json('GET', '/api/articles', ['search' => 'Unique']);

        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        'title' => 'Unique title for search'
                    ]
                ]
            ]);
    }

    public function testArticlesCanBeFilteredByDate()
    {
        $article = Article::factory()->create([
            'published_at' => now()->subDay()
        ]);

        $response = $this->json('GET', '/api/articles', [
            'date_from' => now()->subDays(2)->toDateString(),
            'date_to'   => now()->toDateString()
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonCount(1, 'data');
    }
}
