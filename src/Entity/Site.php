<?php

namespace App\Entity;

use App\Repository\SiteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: SiteRepository::class)]
class Site
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $surface = null;

    #[ORM\Column(nullable: true)]
    private ?int $price = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $localisation = null;

    #[ORM\Column(nullable: true)]
    private ?int $duration = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    private Collection $images;

    #[ORM\OneToMany(mappedBy: 'site', targetEntity: SiteImage::class, orphanRemoval: true, cascade: ['persist'])]
    private Collection $siteImages;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->siteImages = new ArrayCollection();
    }

    public function getImages(): Collection
    {
        return $this->images;
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSurface(): ?int
    {
        return $this->surface;
    }

    public function setSurface(int $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(?string $localisation): self
    {
        $this->localisation = $localisation;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, SiteImage>
     */
    public function getSiteImages(): Collection
    {
        return $this->siteImages;
    }

    public function addSiteImage(SiteImage $siteImage): self
    {
        if (!$this->siteImages->contains($siteImage)) {
            $this->siteImages->add($siteImage);
            $siteImage->setSite($this);
        }

        return $this;
    }

    public function removeSiteImage(SiteImage $siteImage): self
    {
        if ($this->siteImages->removeElement($siteImage)) {
            // set the owning side to null (unless already changed)
            if ($siteImage->getSite() === $this) {
                $siteImage->setSite(null);
            }
        }

        return $this;
    }
}