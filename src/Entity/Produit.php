<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
#[Broadcast]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $lienDiscogs = null;

    #[ORM\Column(length: 50)]
    private ?string $type = null;

    #[ORM\OneToOne(inversedBy: 'produit', cascade: ['persist', 'remove'])]
    private ?Album $idAlbum = null;

    #[ORM\OneToOne(inversedBy: 'produit', cascade: ['persist', 'remove'])]
    private ?Label $idLabel = null;

    #[ORM\OneToOne(inversedBy: 'produit', cascade: ['persist', 'remove'])]
    private ?Artiste $idArtiste = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getLienDiscogs(): ?string
    {
        return $this->lienDiscogs;
    }

    public function setLienDiscogs(string $lienDiscogs): static
    {
        $this->lienDiscogs = $lienDiscogs;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getIdAlbum(): ?Album
    {
        return $this->idAlbum;
    }

    public function setIdAlbum(?Album $idAlbum): static
    {
        $this->idAlbum = $idAlbum;

        return $this;
    }

    public function getIdLabel(): ?Label
    {
        return $this->idLabel;
    }

    public function setIdLabel(?Label $idLabel): static
    {
        $this->idLabel = $idLabel;

        return $this;
    }

    public function getIdArtiste(): ?Artiste
    {
        return $this->idArtiste;
    }

    public function setIdArtiste(?Artiste $idArtiste): static
    {
        $this->idArtiste = $idArtiste;

        return $this;
    }
}
