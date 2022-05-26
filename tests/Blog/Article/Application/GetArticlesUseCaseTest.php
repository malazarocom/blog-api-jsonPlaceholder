<?php

namespace App\Tests\Blog\Article\Application;

use App\Blog\Post\Article\Application\GetArticlesQuery;
use App\Blog\Post\Article\Application\GetArticlesUseCase;
use App\Blog\Post\Article\Domain\Article;
use App\Blog\Post\Article\Domain\ArticleId;
use App\Blog\Post\Article\Domain\ArticleNotFound;
use App\Blog\Post\Article\Domain\ArticleRepository;
use App\Blog\Post\Article\Domain\ArticlesCollection;
use App\Blog\Post\Author\Domain\Author;
use App\Blog\Post\Author\Domain\AuthorId;
use PHPUnit\Framework\TestCase;

class GetArticlesUseCaseTest extends TestCase
{
    private ArticleId $articleNotFound;
    private ArticleId $firstArticleId;
    private ArticleId $secondArticleId;

    /** @beforeClass */
    public function setUpArticleIds(): void
    {
        $this->articleNotFound = new ArticleId('9999');
        $this->firstArticleId = new ArticleId('1');
        $this->secondArticleId = new ArticleId('2');
    }

    private ArticlesCollection $articlesExpected;
    private Article $firstArticle;
    private Article $secondArticle;

    public function setUpArticlesCollection()
    {
        $this->firstArticle = new Article(
            $this->firstArticleId,
            Author::createEmpty(new AuthorId(1)),
            'The first article title',
            'The first article body'
        );
        $this->secondArticle = new Article(
            $this->secondArticleId,
            Author::createEmpty(new AuthorId(1)),
            'The second article title',
            'The second article body'
        );

        $this->articlesExpected = new ArticlesCollection([
            $this->firstArticle,
            $this->secondArticle,
        ]);
    }

    private ArticleRepository $mockArticleRepository;
    private GetArticlesUseCase $getArticlesUseCase;

    public function setUpArticleRepositoryMockAndGetArticlesUseCase()
    {
        $this->mockArticleRepository = $this->createMock(ArticleRepository::class);

        $this->mockArticleRepository->expects($this->any())
            ->method('findAll')
            ->willReturn($this->articlesExpected);

        $this->mockArticleRepository->expects($this->any())
            ->method('findById')
            ->with(
                $this->callback(function (ArticleId $articleId) {
                    $articlesIdToTest = [$this->articleNotFound, $this->firstArticleId, $this->secondArticleId];

                    return in_array($articleId, $articlesIdToTest);
                })
            )
            ->willReturnCallback(function (ArticleId $articleId) {
                if ($articleId->getValue() === $this->articleNotFound->getValue()) {
                    throw new ArticleNotFound($this->articleNotFound);
                }

                if (1 === $articleId->getValue()) {
                    return $this->firstArticle;
                }

                return $this->secondArticle;
            });

        $this->getArticlesUseCase = new GetArticlesUseCase($this->mockArticleRepository);
    }

    public function setUp(): void
    {
        $this->setUpArticleIds();
        $this->setUpArticlesCollection();
        $this->setUpArticleRepositoryMockAndGetArticlesUseCase();
    }

    /** @test */
    public function shouldReturnAllArticlesWhenQueryHasNotArticleId()
    {
        $query = new GetArticlesQuery();
        $articles = $this->getArticlesUseCase->search($query);

        $this->assertEqualsCanonicalizing(
            $this->articlesExpected,
            $articles,
            'Should return all articles when query has not articleId'
        );
    }

    /** @test */
    public function shouldReturnTheArticleInsideArticlesExpected()
    {
        $query = new GetArticlesQuery($this->secondArticleId);
        $article = $this->getArticlesUseCase->search($query)->getFirst();

        $this->assertEquals(
            $this->secondArticle,
            $article,
            'Should return the article inside articlesCollection'
        );
    }

    /** @test */
    public function shouldThrowArticleNotExists()
    {
        $query = new GetArticlesQuery($this->articleNotFound);
        $this->expectException(ArticleNotFound::class);
        $this->getArticlesUseCase->search($query);
    }
}
