<?php

namespace App\Blog\Post\Article\Application;

use App\Blog\Post\Article\Domain\ArticleNotFound;
use App\Blog\Post\Article\Domain\ArticleRepository;
use App\Blog\Post\Article\Domain\ArticlesCollection;

class GetArticlesUseCase
{
    public function __construct(
        private ArticleRepository $articleRepository
    ) {
    }

    /**
     * @throws ArticleNotFound
     *
     * @return ArticlesCollection;
     */
    public function search(GetArticlesQuery $query): ArticlesCollection
    {
        if (!is_null($query->getArticleId())) {
            $article = $this->articleRepository->findById($query->getArticleId());

            return new ArticlesCollection([$article]);
        }

        return $this->articleRepository->findAll();
    }
}
