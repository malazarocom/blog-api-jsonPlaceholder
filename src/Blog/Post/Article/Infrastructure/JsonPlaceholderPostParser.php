<?php

namespace App\Blog\Post\Article\Infrastructure;

use App\Blog\Post\Article\Domain\Article;
use App\Blog\Post\Article\Domain\ArticleId;
use App\Blog\Post\Author\Domain\Author;
use App\Blog\Post\Author\Domain\AuthorId;
use App\Blog\Post\Author\Infrastructure\JsonPlaceholderAuthorParser;

class JsonPlaceholderPostParser
{
    public function __construct(
        public JsonPlaceholderAuthorParser $authorParser
    ) {
    }

    public function toDomain(array $jsonPlaceholderPost, array $jsonPlaceholderAuthor): Article
    {
        $articleId = new ArticleId($jsonPlaceholderPost['id']);
        $title = $jsonPlaceholderPost['title'];
        $body = $jsonPlaceholderPost['body'];
        $author = $this->authorParser->toDomain($jsonPlaceholderAuthor);

        return new Article($articleId, $author, $title, $body);
    }
}
