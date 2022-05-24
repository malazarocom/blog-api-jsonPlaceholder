<?php

namespace App\Blog\Post\Article\Domain;

use App\Blog\Post\Article\Domain\Article;
use App\Shared\Collection;

class ArticlesCollection extends Collection
{
    protected function type(): string
    {
        return Article::class;
    }
}
