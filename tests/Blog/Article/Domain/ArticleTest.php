<?php

namespace App\Tests\Blog\Article\Domain;

use App\Blog\Post\Author\Domain\Author;
use App\Blog\Post\Article\Domain\Article;
use App\Blog\Post\Author\Domain\AuthorId;
use App\Blog\Post\Article\Domain\ArticleId;
use PHPUnit\Framework\TestCase;

class ArticleTest extends TestCase
{
    private Article $articleWithAuthorId;
    private array $keysArticleMustHaveAsArray = ['id', 'title', 'body', 'author'];

    /** @before */
    public function setUpValidArticle(): void
    {
        $this->articleWithAuthorId = new Article(
            new ArticleId("1"),
            Author::createEmpty(new AuthorId(1)),
            'The article title',
            'The article body'
        );
    }

    /** @test */
    public function asArrayShouldReturnTheArticleAsArray()
    {
        $articleAsArray = $this->articleWithAuthorId->asArray();
        $this->assertIsArray($articleAsArray);

        foreach ($this->keysArticleMustHaveAsArray as $keyArticleExpected) {
            $this->assertArrayHasKey($keyArticleExpected, $articleAsArray, "Missing key <{$keyArticleExpected}>");
        }
    }
}
