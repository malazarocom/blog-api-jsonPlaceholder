<?php

namespace App\Shared\Infrastructure\JsonPlaceholder;

use App\Shared\Infrastructure\JsonPlaceholder\JsonPlaceholderRequest;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class JsonPlaceholderClient
{
    public function __construct(
        private HttpClientInterface $client
    ) {
        $this->client = $client;
    }

    public function request(JsonPlaceholderRequest $request)
    {
        $options = [];

        if ($request->hasQuery()) {
            $options['query'] = $request->getQuery();
        }

        if ($request->hasBody()) {
            $options['json'] = $request->getBody();
        }

        $response = $this->client->request(
            $request->getMethod(),
            $request->getEndpoint(),
            $options
        );

        return $response->toArray(false);
    }
}
