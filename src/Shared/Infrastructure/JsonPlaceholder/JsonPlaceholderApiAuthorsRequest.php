<?php

namespace App\Shared\Infrastructure\JsonPlaceholder;

use App\Shared\Infrastructure\JsonPlaceholder\JsonPlaceholderGetRequest;
use App\Blog\Post\Author\Domain\AuthorId;

class JsonPlaceholderApiAuthorsRequest extends JsonPlaceholderGetRequest
{
    public function __construct(AuthorId $authorId = null, $query = null)
    {
        $endPoint = is_null($authorId) ? '/users' : "users/{$authorId->getValue()}";

        parent::__construct($endPoint, $query);
    }
}
