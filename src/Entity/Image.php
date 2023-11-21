<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
#[Vich\Uploadable]
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

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $attachment = null;

    #[Vich\UploadableField(mapping: 'realisation_img', fileNameProperty: 'attachment')]
    private ?File $attachmentFile = null;

    #[ORM\Column(type: Types::STRING)]
    private ?string $room = null;

    #[ORM\ManyToOne(targetEntity: Site::class, inversedBy: 'images')]
    #[ORM\JoinColumn(name: 'site_id', referencedColumnName: 'id')]
    private ?Site $site;


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

    public function getAttachment(): ?string
    {
        return $this->attachment;
    }

    public function setAttachment(string $attachment): self
    {
        $this->attachment = $attachment;

        return $this;
    }

    public function getAttachmentFile(): ?File
    {
        return $this->attachmentFile;
    }

    public function setAttachmentFile(File $attachmentFile): self
    {
        $this->attachmentFile = $attachmentFile;


        return $this;
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
    public function getSite(): ?Site
    {
        return $this->site;
    }
    public function setSite(?Site $site): self
    {
        $this->site = $site;
        return $this;
    }

    public function __toString()
    {
        return $this->getThumbnail();
    }
}
