<?php

namespace App\Blog\Post\Author\Domain;

use App\Shared\Domain\DomainError;

final class AuthorNotFound extends DomainError
{
    public function __construct(private AuthorId $authorId)
    {
        $this->authorId = $authorId;
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'author_not_found';
    }

    protected function errorMessage(): string
    {
        return sprintf('The author <%s> has not been found', $this->authorId->getValue());
    }
}
