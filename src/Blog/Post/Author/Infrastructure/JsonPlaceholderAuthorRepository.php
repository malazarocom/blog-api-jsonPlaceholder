<?php

namespace App\Blog\Post\Author\Infrastructure;

use App\Blog\Post\Author\Domain\AuthorId;
use App\Blog\Post\Author\Domain\Author;
use App\Blog\Post\Author\Domain\AuthorsCollection;
use App\Blog\Post\Author\Domain\AuthorNotFound;
use App\Blog\Post\Author\Domain\AuthorRepository;
use App\Shared\Infrastructure\JsonPlaceholder\JsonPlaceholderClient;
use App\Shared\Infrastructure\JsonPlaceholder\JsonPlaceholderApiAuthorsRequest;

class JsonPlaceholderAuthorRepository implements AuthorRepository
{
    public function __construct(
        private JsonPlaceholderAuthorParser $jsonPlaceholderAuthorParser,
        private JsonPlaceholderClient $jsonPlaceholderClient
    ) {
    }

    public function findAll(): AuthorsCollection
    {
        $authors = $this->jsonPlaceholderClient->request(new JsonPlaceholderApiAuthorsRequest());

        $authorsDomain = array_map(function ($author) {
            return $this->jsonPlaceholderAuthorParser->toDomain($author);
        }, $authors);

        return new AuthorsCollection($authorsDomain);
    }

    public function findById(AuthorId $id): Author
    {
        $author = $this->jsonPlaceholderClient->request(new JsonPlaceholderApiAuthorsRequest($id));

        if (empty($author)) {
            throw new AuthorNotFound($id);
        }

        return $this->jsonPlaceholderAuthorParser->toDomain($author);
    }
}
