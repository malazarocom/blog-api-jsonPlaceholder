<?php

namespace App\Blog\Post\Article\Domain;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Blog\Post\Author\Domain\Author;
use Symfony\Component\Validator\Constraints as Assert;

/** A article. */
#[ApiResource(
    collectionOperations: ['get', 'post'],
    itemOperations: ['get'],
    shortName: 'article'
)]
class Article
{
    #[ApiProperty(identifier: true)]
    private ArticleId $id;

    #[Assert\NotBlank]
    private Author $author;

    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 150,
        minMessage: 'Your title must be at least {{ limit }} characters long',
        maxMessage: 'Your title name cannot be longer than {{ limit }} characters',
    )]

    private string $title;

    #[Assert\NotBlank]
    private string $body;

    private \DateTimeImmutable $createdAt;

    private \DateTimeImmutable $updatedAt;

    public function __construct(ArticleId $id, Author $author, string $title, string $body)
    {
        $this->id = $id;
        $this->author = $author;
        $this->title = $title;
        $this->body = $body;
    }

    public function getId(): ?ArticleId
    {
        return $this->id;
    }

    public function getAuthor(): Author
    {
        return $this->author;
    }

    public function setAuthor(Author $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function asArray(): array
    {
        return [
            'id' => $this->getId()->getValue(),
            'author' => $this->getAuthor()->asArray(),
            'title' => $this->getTitle(),
            'body' => $this->getBody(),
        ];
    }
}
