<?php

namespace App\Blog\Post\Author\Domain;

use App\Blog\Post\Author\Domain\AuthorsCollection;
use App\Blog\Post\Author\Domain\AuthorNotFound;

interface AuthorRepository
{
    public function findAll(): AuthorsCollection;

    /**
     * @param AuthorId $id
     * @return Author
     * @throws AuthorNotFound
     */
    public function findById(AuthorId $id): Author;
}
