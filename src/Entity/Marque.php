<?php

namespace App\Entity;

use App\Repository\MarqueRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MarqueRepository::class)]
class Marque
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomMarque = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(length: 255)]
    private ?string $paysOrigine = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomMarque(): ?string
    {
        return $this->nomMarque;
    }

    public function setNomMarque(string $nomMarque): static
    {
        $this->nomMarque = $nomMarque;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getPaysOrigine(): ?string
    {
        return $this->paysOrigine;
    }

    public function setPaysOrigine(string $paysOrigine): static
    {
        $this->paysOrigine = $paysOrigine;

        return $this;
    }
    public function __toString(): string
    {
        // Vérifiez si le nom de la marque est défini avant de le retourner
        if ($this->getNomMarque()) {
            return $this->getNomMarque();
        }

        // Si le nom de la marque est null ou vide, retournez une chaîne par défaut
        return 'Marque inconnue';
    }
}
