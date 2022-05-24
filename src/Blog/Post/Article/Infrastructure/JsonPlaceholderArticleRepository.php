<?php

namespace App\Blog\Post\Article\Infrastructure;

use App\Blog\Post\Article\Domain\Article;
use App\Blog\Post\Article\Domain\ArticleId;
use App\Blog\Post\Article\Domain\ArticlesCollection;
use App\Blog\Post\Article\Domain\ArticleRepository;
use App\Blog\Post\Article\Domain\ArticleNotFound;
use App\Blog\Post\Author\Domain\AuthorId;
use App\Shared\Infrastructure\JsonPlaceholder\JsonPlaceholderClient;
use App\Shared\Infrastructure\JsonPlaceholder\JsonPlaceholderApiArticlesRequest;
use App\Shared\Infrastructure\JsonPlaceholder\JsonPlaceholderApiAuthorsRequest;

final class JsonPlaceholderArticleRepository implements ArticleRepository
{
    public function __construct(
        private JsonPlaceholderPostParser $jsonParser,
        private JsonPlaceholderClient $jsonPlaceholderClient
    ) {
    }

    public function findAll(): ArticlesCollection
    {
        $articlesFromExternalProvider = $this->jsonPlaceholderClient->request(new JsonPlaceholderApiArticlesRequest());

        $articlesArray = array_map(function ($articleFromExternalProvider) {
            $authorFromExternalProvider = $this->getAuthorById($articleFromExternalProvider);
            return $this->jsonParser->toDomain($articleFromExternalProvider, $authorFromExternalProvider);
        }, $articlesFromExternalProvider);

        return new ArticlesCollection($articlesArray);
    }

    public function findById(ArticleId $id): Article
    {
        $articleFromExternalProvider = $this->jsonPlaceholderClient->request(new JsonPlaceholderApiArticlesRequest($id));

        if (empty($articleFromExternalProvider)) {
            throw new ArticleNotFound($id);
        }

        $authorFromExternalProvider = $this->getAuthorById($articleFromExternalProvider);

        return $this->jsonParser->toDomain($articleFromExternalProvider, $authorFromExternalProvider);
    }

    private function getAuthorById($articleFromExternalProvider)
    {
        if (!array_key_exists('userId', $articleFromExternalProvider)) {
            return null;
        }
        return $this->jsonPlaceholderClient->request(new JsonPlaceholderApiAuthorsRequest(new AuthorId($articleFromExternalProvider['userId'])));
    }
}
