<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class FetchArticlesCommandTest extends TestCase
{
    use RefreshDatabase;

    // public function testCommandFetchesArticles()
    // {
    //     // Mock the HTTP client requests
    //     Http::fake([
    //         'https://newsapi.org/v2/top-headlines*' => Http::response(['articles' => []], 200),
    //         'https://content.guardianapis.com/search*' => Http::response(['response' => ['results' => []]], 200),
    //         'https://api.nytimes.com/svc/topstories/v2/home.json*' => Http::response(['results' => []], 200),
    //     ]);

    //     // Call the artisan command
    //     Artisan::call('fetch:articles');

    //     // Assert that the HTTP requests were made
    //     Http::assertSent(function ($request) {
    //         return Str::startsWith($request->url(), [
    //             'https://newsapi.org/v2/top-headlines',
    //             'https://content.guardianapis.com/search',
    //             'https://api.nytimes.com/svc/topstories/v2/home.json'
    //         ]);
    //     });

    // }
}
