<?php

namespace App\Blog\Post\Article\Domain;

use App\Blog\Post\Article\Domain\Article;
use App\Blog\Post\Article\Domain\ArticlesCollection;
use App\Blog\Post\Article\Domain\ArticleId;

interface ArticleRepository
{
    public function findAll(): ArticlesCollection;

    public function findById(ArticleId $id): Article;
}
