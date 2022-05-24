<?php

namespace App\Blog\Post\Article\Domain;

use App\Shared\Domain\DomainError;

final class ArticleNotFound extends DomainError
{
    public function __construct(private ArticleId $articleId)
    {
        $this->articleId = $articleId;
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'article_not_found';
    }

    protected function errorMessage(): string
    {
        return sprintf('The article <%s> has not been found', $this->articleId->getValue());
    }
}
