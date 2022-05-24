<?php

namespace App\Blog\Post\Author\Infrastructure;

use App\Blog\Post\Author\Domain\Author;
use App\Blog\Post\Author\Domain\AuthorId;

class JsonPlaceholderAuthorParser
{

    public function toDomain(array $jsonPlaceholderUser): Author
    {
        $authorId = new AuthorId($jsonPlaceholderUser['id']);
        $name = $jsonPlaceholderUser['name'];
        $userName = $jsonPlaceholderUser['username'];
        $email = $jsonPlaceholderUser['email'];
        $phone = $jsonPlaceholderUser['phone'];
        $website = $jsonPlaceholderUser['website'];

        return new Author(
            $authorId,
            $name,
            $userName,
            $email,
            $phone,
            $website
        );
    }
}
