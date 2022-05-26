<?php

namespace App\Blog\Post\Article\Domain;

use App\Shared\Collection;

class ArticlesCollection extends Collection
{
    protected function type(): string
    {
        return Article::class;
    }
}
