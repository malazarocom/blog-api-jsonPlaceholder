<?php

declare(strict_types=1);

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Blog\Post\Article\Domain\Article;
use App\Blog\Post\Article\Domain\ArticleRepository;

final class ArticleCollectionDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    public function __construct(
        private ArticleRepository $repository
    ) {
    }

    /**
     * @param array<string, mixed> $context
     */
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Article::class === $resourceClass;
    }

    /**
     * @param array<string, mixed> $context
     *
     * @throws \RuntimeException
     *
     * @return iterable<Article>
     */
    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        try {
            $articlesDomain = $this->repository->findAll();
            $articlesArray = array_map(function ($articleDomain) {
                return $articleDomain->asArray();
            }, iterator_to_array($articlesDomain));

            return $articlesArray;
        } catch (\Exception $e) {
            throw new \RuntimeException(sprintf('Unable to retrieve articles from external source: %s', $e->getMessage()));
        }
    }
}
