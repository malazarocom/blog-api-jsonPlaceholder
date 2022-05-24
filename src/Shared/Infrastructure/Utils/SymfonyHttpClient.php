<?php

namespace App\Shared\Infrastructure\Utils;

use Symfony\Contracts\HttpClient\HttpClientInterface as SymfonyHttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class SymfonyHttpClient implements HttpClientInterface
{
    public function __construct(
        private SymfonyHttpClientInterface $httpClient
    ) {
    }

    public function request(string $method, string $url): ResponseInterface
    {
        return $this->httpClient->request($method, $url);
    }
}
