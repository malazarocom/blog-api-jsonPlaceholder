<?php

namespace App\Blog\Post\Author\Application;

use App\Blog\Post\Article\Domain\ArticleId;

class GetArticleAuthorQuery
{
    public function __construct(
        private ArticleId $articleId
    ) {
    }

    public function getArticleId(): ArticleId
    {
        return $this->articleId;
    }
}
