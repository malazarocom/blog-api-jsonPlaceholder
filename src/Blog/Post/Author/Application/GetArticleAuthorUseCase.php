<?php

namespace App\Blog\Post\Author\Application;

use App\Blog\Post\Article\Domain\ArticleNotFound;
use App\Blog\Post\Article\Domain\ArticleRepository;
use App\Blog\Post\Author\Domain\Author;
use App\Blog\Post\Author\Domain\AuthorNotFound;
use App\Blog\Post\Author\Domain\AuthorRepository;

class GetArticleAuthorUseCase
{
    public function __construct(
        private ArticleRepository $articleRepository,
        private AuthorRepository $authorRepository
    ) {
    }

    /**
     * @throws ArticleNotFound
     * @throws AuthorNotFound
     */
    public function search(GetArticleAuthorQuery $query): Author
    {
        $article = $this->articleRepository->findById($query->getArticleId());

        return $this->authorRepository->findById($article->getAuthor()->getId());
    }
}
