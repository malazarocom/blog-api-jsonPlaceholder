<?php

namespace App\Shared\Infrastructure\JsonPlaceholder;

use App\Shared\Infrastructure\JsonPlaceholder\JsonPlaceholderRequest;

class JsonPlaceholderGetRequest extends JsonPlaceholderRequest
{
    public function __construct(string $endpoint, $query = null)
    {
        parent::__construct($endpoint, 'GET', $query);
    }
}
