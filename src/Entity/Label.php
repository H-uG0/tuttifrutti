<?php

namespace App\Entity;

use App\Repository\LabelRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: LabelRepository::class)]
#[Broadcast]
class Label
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $contactInfo = null;

    #[ORM\Column(type: Types::SIMPLE_ARRAY, nullable: true)]
    private ?array $liens = null;

    #[ORM\OneToOne(mappedBy: 'idLabel', cascade: ['persist', 'remove'])]
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getContactInfo(): ?string
    {
        return $this->contactInfo;
    }

    public function setContactInfo(?string $contactInfo): static
    {
        $this->contactInfo = $contactInfo;

        return $this;
    }

    public function getLiens(): ?array
    {
        return $this->liens;
    }

    public function setLiens(?array $liens): static
    {
        $this->liens = $liens;

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
            $this->produit->setIdLabel(null);
        }

        // set the owning side of the relation if necessary
        if ($produit !== null && $produit->getIdLabel() !== $this) {
            $produit->setIdLabel($this);
        }

        $this->produit = $produit;

        return $this;
    }
}
