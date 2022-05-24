<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Blog\Post\Article\Domain\Article;

class ArticleDataPersister implements DataPersisterInterface
{
    public function __construct(
        private DataPersisterInterface $decoratedDataPersister
    ) {
    }
    public function supports($data): bool
    {
        return $data instanceof Article;
    }

    public function persist($data)
    {
        return $this->decoratedDataPersister->persist($data);
    }
    public function remove($data)
    {
        $this->decoratedDataPersister->remove($data);
    }
}
