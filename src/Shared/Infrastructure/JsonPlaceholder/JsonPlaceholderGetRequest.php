<?php

namespace App\Shared\Infrastructure\JsonPlaceholder;

class JsonPlaceholderGetRequest extends JsonPlaceholderRequest
{
    public function __construct(string $endpoint, $query = null)
    {
        parent::__construct($endpoint, 'GET', $query);
    }
}
