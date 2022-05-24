<?php

namespace App\Blog\Post\Article\Application;

use App\Blog\Post\Article\Domain\ArticleId;

class GetArticlesQuery
{
    private ?ArticleId $articleId;

    public function __construct(?ArticleId $articleId = null)
    {
        $this->articleId = $articleId;
    }

    public function getArticleId(): ?ArticleId
    {
        return $this->articleId;
    }
}
