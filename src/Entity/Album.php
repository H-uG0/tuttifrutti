<?php

namespace App\Entity;

use App\Repository\AlbumRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: AlbumRepository::class)]
#[Broadcast]
class Album
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $nom = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $artiste = null;

    #[ORM\Column(type: Types::SIMPLE_ARRAY, nullable: true)]
    private ?array $styles = null;

    #[ORM\Column(type: Types::SIMPLE_ARRAY, nullable: true)]
    private ?array $genres = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $sortie = null;

    #[ORM\Column(type: Types::SIMPLE_ARRAY, nullable: true)]
    private ?array $Tracklist = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $label = null;

    #[ORM\Column(type: Types::SIMPLE_ARRAY, nullable: true)]
    private ?array $format = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $pays = null;

    #[ORM\OneToOne(mappedBy: 'idAlbum', cascade: ['persist', 'remove'])]
    private ?Produit $produit = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getArtiste(): ?string
    {
        return $this->artiste;
    }

    public function setArtiste(?string $artiste): static
    {
        $this->artiste = $artiste;

        return $this;
    }

    public function getStyles(): ?array
    {
        return $this->styles;
    }

    public function setStyles(?array $styles): static
    {
        $this->styles = $styles;

        return $this;
    }

    public function getGenres(): ?array
    {
        return $this->genres;
    }

    public function setGenres(?array $genres): static
    {
        $this->genres = $genres;

        return $this;
    }

    public function getSortie(): ?string
    {
        return $this->sortie;
    }

    public function setSortie(?string $sortie): static
    {
        $this->sortie = $sortie;

        return $this;
    }

    public function getTracklist(): ?array
    {
        return $this->Tracklist;
    }

    public function setTracklist(?array $Tracklist): static
    {
        $this->Tracklist = $Tracklist;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function getFormat(): ?array
    {
        return $this->format;
    }

    public function setFormat(?array $format): static
    {
        $this->format = $format;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(?string $pays): static
    {
        $this->pays = $pays;

        return $this;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): static
    {
        // unset the owning side of the relation if necessary
        if ($produit === null && $this->produit !== null) {
            $this->produit->setIdAlbum(null);
        }

        // set the owning side of the relation if necessary
        if ($produit !== null && $produit->getIdAlbum() !== $this) {
            $produit->setIdAlbum($this);
        }

        $this->produit = $produit;

        return $this;
    }
}
