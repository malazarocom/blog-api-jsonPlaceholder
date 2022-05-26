<?php

namespace App\Blog\Post\Article\Domain;

interface ArticleRepository
{
    public function findAll(): ArticlesCollection;

    public function findById(ArticleId $id): Article;
}
