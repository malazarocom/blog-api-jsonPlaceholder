<?php

declare(strict_types=1);

namespace App\Tests\Blog\Article\Domain;

use App\Blog\Post\Article\Domain\Article;
use Symfony\Component\HttpFoundation\Response;
use ApiPlatform\Core\Bridge\Symfony\Routing\Router;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Client;
use Symfony\Contracts\Service\ServiceProviderInterface;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Blog\Post\Article\Domain\ArticleId;
use App\Blog\Post\Article\Domain\AuthorId as DomainAuthorId;
use App\Blog\Post\Author\Domain\Author;
use App\Blog\Post\Author\Domain\AuthorId;

class ArticlesApiTest extends ApiTestCase
{
    private Client $client;

    protected function setup(): void
    {
        $this->client = static::createClient();
    }

    public function testGetCollection(): void
    {
        // The client implements Symfony HttpClient's `HttpClientInterface`, and the response `ResponseInterface`
        $response = $this->client->request('GET', '/api/articles');
        self::assertResponseIsSuccessful();
        self::assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        self::assertJsonContains([
            '@context' => '/api/contexts/article',
            '@id' => '/api/articles',
            '@type' => 'hydra:Collection'
        ]);
    }

    public function testCreateArticle(): void
    {
        $response = $this->client->request('POST', '/api/articles', ['json' => [
            "id" => [
                "value" => "string"
            ],
            "author" => [
                "id" => [
                    "value" => 1
                ],
                "name" => "string",
                "username" => "string",
                "email" => "string",
                "phone" => "string",
                "website" => "string"
            ],
            "title" => "string",
            "body" => "string",
            "createdAt" => "2022-05-24T15:41:37.351Z",
            "updatedAt" => "2022-05-24T15:41:37.351Z"

        ]]);

        // TODO self::assertResponseStatusCodeSame(Response::HTTP_CREATED);
        self::assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        // self::assertMatchesResourceItemJsonSchema(Article::class);
    }
}
