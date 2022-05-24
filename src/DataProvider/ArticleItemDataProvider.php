<?php

declare(strict_types=1);

namespace App\DataProvider;

use ApiPlatform\Core\Exception\InvalidIdentifierException;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\SerializerAwareDataProviderInterface;
use ApiPlatform\Core\DataProvider\SerializerAwareDataProviderTrait;
use App\Blog\Post\Article\Domain\Article;
use App\Blog\Post\Article\Domain\ArticleId;
use App\Blog\Post\Article\Domain\ArticleRepository;

final class ArticleItemDataProvider implements ItemDataProviderInterface, SerializerAwareDataProviderInterface
{
    use SerializerAwareDataProviderTrait;

    public function __construct(private ArticleRepository $repository)
    {
    }

    /**
     * @param array<string, mixed> $context
     */
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Article::class === $resourceClass;
    }

    /**
     * @param array<int, mixed> $context
     *
     * @throws InvalidIdentifierException
     *
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?Article
    {
        if (!$id) {
            throw new InvalidIdentifierException('Invalid id key type.');
        }

        try {
            return $this->repository->findById(new ArticleId($id));
        } catch (\Exception $e) {
            throw new \RuntimeException(sprintf('Unable to retrieve article %s from external source: %s', $id, $e->getMessage()));
        }
    }
}
