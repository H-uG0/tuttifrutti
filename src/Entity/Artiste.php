<?php

namespace App\Entity;

use App\Repository\ArtisteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: ArtisteRepository::class)]
#[Broadcast]
class Artiste
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $vraiNom = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::SIMPLE_ARRAY, nullable: true)]
    private ?array $sites = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $alias = null;

    #[ORM\Column(type: Types::SIMPLE_ARRAY, nullable: true)]
    private ?array $membres = null;

    #[ORM\Column(type: Types::SIMPLE_ARRAY, nullable: true)]
    private ?array $variantes = null;

    #[ORM\Column(type: Types::SIMPLE_ARRAY, nullable: true)]
    private ?array $groupes = null;

    #[ORM\OneToOne(mappedBy: 'idArtiste', cascade: ['persist', 'remove'])]
    private ?Produit $produit = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getVraiNom(): ?string
    {
        return $this->vraiNom;
    }

    public function setVraiNom(?string $vraiNom): static
    {
        $this->vraiNom = $vraiNom;

        return $this;
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

    public function getSites(): ?array
    {
        return $this->sites;
    }

    public function setSites(?array $sites): static
    {
        $this->sites = $sites;

        return $this;
    }

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function setAlias(?string $alias): static
    {
        $this->alias = $alias;

        return $this;
    }

    public function getMembres(): ?array
    {
        return $this->membres;
    }

    public function setMembres(?array $membres): static
    {
        $this->membres = $membres;

        return $this;
    }

    public function getVariantes(): ?array
    {
        return $this->variantes;
    }

    public function setVariantes(?array $variantes): static
    {
        $this->variantes = $variantes;

        return $this;
    }

    public function getGroupes(): ?array
    {
        return $this->groupes;
    }

    public function setGroupes(?array $groupes): static
    {
        $this->groupes = $groupes;

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
            $this->produit->setIdArtiste(null);
        }

        // set the owning side of the relation if necessary
        if ($produit !== null && $produit->getIdArtiste() !== $this) {
            $produit->setIdArtiste($this);
        }

        $this->produit = $produit;

        return $this;
    }
}
