<?php

namespace App\Shared\Infrastructure\Utils;

use App\Shared\Infrastructure\Utils\Exception\HttpRequestException;
use Symfony\Contracts\HttpClient\ResponseInterface;

interface HttpClientInterface
{
    /**
     * @throws HttpRequestException
     */
    public function request(string $method, string $url): ResponseInterface;
}
