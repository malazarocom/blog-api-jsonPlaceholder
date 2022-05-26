<?php

namespace App\Shared\Infrastructure\JsonPlaceholder;

use App\Blog\Post\Article\Domain\ArticleId;

class JsonPlaceholderApiArticlesRequest extends JsonPlaceholderGetRequest
{
    public function __construct(ArticleId $articleId = null, $query = null)
    {
        $endpoint = is_null($articleId) ? '/posts?_page=1&_limit=12' : "/posts/{$articleId->getValue()}";

        parent::__construct($endpoint, $query);
    }
}
