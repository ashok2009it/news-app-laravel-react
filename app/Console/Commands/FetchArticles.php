<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use App\Models\Article;
use Carbon\Carbon;

class FetchArticles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:articles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $output;

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting article fetch...');

        $spinner = ['-', '\\', '|', '/'];
        $spinnerPosition = 0;

        $this->fetchWithSpinner('Fetching from NewsAPI...', function () {
            $this->fetchFromNewsAPI();
        }, $spinner, $spinnerPosition);

        $this->fetchWithSpinner('Fetching from The Guardian...', function () {
            $this->fetchFromTheGuardian();
        }, $spinner, $spinnerPosition);

        $this->fetchWithSpinner('Fetching from The New York Times...', function () {
            $this->fetchFromNYTimes();
        }, $spinner, $spinnerPosition);

        $this->info("\nArticles have been updated!");
    }

    private function fetchFromNewsAPI()
    {
        $client = new Client();

        $response = $client->get('https://newsapi.org/v2/top-headlines', [
            'query' => [
                'apiKey' => config('newsapi.news_api'),
                'language' => 'en',
                'pageSize' => 100,
            ]
        ]);

        $articles = json_decode($response->getBody(), true)['articles'];

        foreach ($articles as $article) {
            Article::updateOrCreate(
                ['title' => $article['title'], 'source_name' => $article['source']['name']],
                [
                    'author' => $article['author'],
                    'description' => $article['description'],
                    'source_url' => $article['url'],
                    'image_url' => $article['urlToImage'],
                    'published_at' => Carbon::parse($article['publishedAt'])->format('Y-m-d H:i:s'),
                ]
            );
        }
    }

    private function fetchFromTheGuardian()
    {
        $client = new Client();

        $response = $client->get('https://content.guardianapis.com/search', [
            'query' => [
                'api-key' => config('newsapi.theguardian'),
                'show-fields' => 'all',
                'page-size' => 100,
            ]
        ]);

        $articles = json_decode($response->getBody(), true)['response']['results'];

        foreach ($articles as $article) {
            $fields = $article['fields'] ?? [];

            Article::updateOrCreate(
                ['title' => $article['webTitle'], 'source_name' => 'The Guardian'],
                [
                    'author' => $fields['byline'] ?? null, // Using null coalescing operator
                    'description' => $fields['trailText'] ?? null, // If 'trailText' is not set, default to null
                    'source_url' => $article['webUrl'],
                    'image_url' => $fields['thumbnail'] ?? null, // If 'thumbnail' is not set, default to null
                    'published_at' => Carbon::parse($article['webPublicationDate'])->toDateTimeString(),
                ]
            );
        }
    }

    private function fetchFromNYTimes()
    {
        $client = new Client();

        $response = $client->get('https://api.nytimes.com/svc/topstories/v2/home.json', [
            'query' => [
                'api-key' => config('newsapi.nytimes'),
            ]
        ]);

        $articles = json_decode($response->getBody(), true)['results'];

        foreach ($articles as $article) {
            Article::updateOrCreate(
                ['title' => $article['title'], 'source_name' => 'The New York Times'],
                [
                    'author' => $article['byline'],
                    'description' => $article['abstract'],
                    'source_url' => $article['url'],
                    'image_url' => $article['multimedia'][0]['url'] ?? null,
                    'published_at' => $article['published_date'],
                ]
            );
        }
    }

    private function fetchWithSpinner($message, $fetchCallback, &$spinner, &$spinnerPosition)
    {
        $this->output->write($message . ' ' . $spinner[$spinnerPosition]);

        // Call the provided fetch callback, which does the actual fetching
        $fetchCallback();

        // Ensure to move the spinner forward for next use
        $spinnerPosition = ($spinnerPosition + 1) % count($spinner);

        // Overwrite the spinner with a success message
        $this->output->write("\r$message Done!" . str_repeat(' ', strlen($spinner[$spinnerPosition])));
    }

}
