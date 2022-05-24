<?php

namespace App\Blog\Post\Author\Domain;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Shared\Arrayable;
use App\Blog\Post\Author\Domain\AuthorId;

/** A author of a article. */
#[ApiResource]
class Author implements Arrayable
{
    #[ApiProperty(identifier: true)]
    private AuthorId $id;
    private string $name;
    private string $username;
    private string $email;
    private string $phone;
    private string $website;

    public function __construct(
        AuthorId $id,
        string $name,
        string $username,
        string $email,
        string $phone,
        string $website,
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->username = $username;
        $this->email = $email;
        $this->phone = $phone;
        $this->website = $website;
    }

    public function getId(): AuthorId
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getWebsite(): string
    {
        return $this->website;
    }

    public function asArray(): array
    {
        $asArray = [
            'id'        => $this->getId()->getValue(),
            'name'      => $this->getName(),
            'username'  => $this->getUsername(),
            'email'     => $this->getEmail(),
            'phone'     => $this->getPhone(),
            'website'   => $this->getWebsite(),
        ];

        foreach ($asArray as $field => $value) {
            if (empty($value)) {
                unset($asArray[$field]);
            }
        }

        return $asArray;
    }

    public static function createEmpty(AuthorId $id): self
    {
        return new self(
            $id,
            '',
            '',
            '',
            '',
            ''
        );
    }
}
