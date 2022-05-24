<?php

namespace App\Blog\Post\Author\Domain;

use App\Shared\Collection;

class AuthorsCollection extends Collection
{
    protected function type(): string
    {
        return Author::class;
    }
}
