<?php

namespace App\Shared\Infrastructure\JsonPlaceholder;

abstract class JsonPlaceholderRequest
{
    public function __construct(
        private string $endpoint,
        private string $method = 'GET',
        private ?array $query = null,
        private ?array $body = null
    ) {
    }

    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function hasQuery(): bool
    {
        return !is_null($this->query);
    }

    public function getQuery(): ?array
    {
        return $this->query;
    }

    public function hasBody(): bool
    {
        return !is_null($this->body);
    }

    public function getBody(): ?array
    {
        return $this->body;
    }
}
