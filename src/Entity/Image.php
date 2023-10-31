<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    private ?site $site_id = null;

    #[ORM\Column(length: 150)]
    private ?string $thumbnail = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private ?array $room = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSiteId(): ?site
    {
        return $this->site_id;
    }

    public function setSiteId(?site $site_id): static
    {
        $this->site_id = $site_id;

        return $this;
    }

    public function getThumbnail(): ?string
    {
        return $this->thumbnail;
    }

    public function setThumbnail(string $thumbnail): static
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    public function getRoom(): ?array
    {
        return $this->room;
    }

    public function setRoom(?array $room): static
    {
        $this->room = $room;

        return $this;
    }
}
