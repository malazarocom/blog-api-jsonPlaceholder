<?php

namespace App\Blog\Post\Author\Domain;

interface AuthorRepository
{
    public function findAll(): AuthorsCollection;

    /**
     * @throws AuthorNotFound
     */
    public function findById(AuthorId $id): Author;
}
