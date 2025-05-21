<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ShoppinglistRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;
use App\State\ShoppinglistPostProcessor;

#[ORM\Entity(repositoryClass: ShoppinglistRepository::class)]
#[ApiResource(
    operations: [
        new Post(processor: ShoppinglistPostProcessor::class),
        new GetCollection()
    ]
)]
class Shoppinglist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[ApiProperty(identifier: false)]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    // #[ApiProperty(identifier: true)]
    #[Assert\Unique()]
    // #[Assert\NotNull(message: 'Uuid can not be null')]
    #[ApiFilter(SearchFilter::class, strategy: 'exact')]
    private ?Uuid $uuid = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank]
    #[Assert\NotBlank(message: 'Name can not be blank')]
    #[Assert\NotNull(message: 'Name can not be null')]
    #[Assert\Length(
        min: 2,
        max: 50
    )]
    private ?string $name = null;

    #[ORM\Column(length: 19, nullable: true)]
    private ?string $date = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getUuid(): ?Uuid
    {
        return $this->uuid;
    }

    public function setUuid(?Uuid $uuid): static
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(?string $date): static
    {
        $this->date = $date;

        return $this;
    }
}
