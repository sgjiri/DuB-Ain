<?php

namespace App\Entity;

use App\Repository\SiteImageRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: SiteImageRepository::class)]
#[Vich\Uploadable]
class SiteImage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[Vich\UploadableField(mapping: 'realisation_img', fileNameProperty: 'name', size:'size')]
    private ?File $file = null;

    #[ORM\Column(length: 255, nullable: true)]
    public ?string $name;

    #[ORM\Column]
    private ?int $size = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updaedAt = null;

    #[ORM\ManyToOne(inversedBy: 'siteImages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?site $site = null;

    #[ORM\Column(type: Types::STRING)]
    private ?string $room = null;
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name = null): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(int $size = null): static
    {
        $this->size = $size;

        return $this;
    }

    public function getUpdaedAt(): ?\DateTimeImmutable
    {
        return $this->updaedAt;
    }

    public function setUpdaedAt(?\DateTimeImmutable $updaedAt): static
    {
        $this->updaedAt = $updaedAt;

        return $this;
    }

    public function getSite(): ?site
    {
        return $this->site;
    }

    public function setSite(?site $site): static
    {
        $this->site = $site;

        return $this;
    }

    public function setFile(?File $file): self
    {
        $this->file = $file;

        if(null != $file){
            $this->updaedAt = new \DateTimeImmutable();
        }


        return $this;
    }

    public function getFile():?File
    {
        return $this->file;
    }

    public function getRoom(): ?string
    {
        return $this->room;
    }

    public function setRoom(?string $room): static
    {
        $this->room = $room;

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
