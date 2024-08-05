<?php

namespace App\Entity;

use App\Repository\VoitureRepository;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;


#[ORM\Entity]

#[Vich\Uploadable]


class Voiture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomVoiture = null;

    #[ORM\Column]
    private ?int $puissance = null;

    #[ORM\Column(length: 255)]
    private ?string $caracteristique = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Marque $marque = null;

    #[Vich\UploadableField(mapping: 'voiture', fileNameProperty: 'image')]
    private ?File $imageFile = null;
    #[ORM\Column(nullable: true)]
    private ?string $image = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomVoiture(): ?string
    {
        return $this->nomVoiture;
    }

    public function setNomVoiture(string $nomVoiture): static
    {
        $this->nomVoiture = $nomVoiture;

        return $this;
    }

    public function getPuissance(): ?int
    {
        return $this->puissance;
    }

    public function setPuissance(int $puissance): static
    {
        $this->puissance = $puissance;

        return $this;
    }

    public function getCaracteristique(): ?string
    {
        return $this->caracteristique;
    }

    public function setCaracteristique(string $caracteristique): static
    {
        $this->caracteristique = $caracteristique;

        return $this;
    }

    public function getMarque(): ?Marque
    {
        return $this->marque;
    }

    public function setMarque(?Marque $marque): static
    {
        $this->marque = $marque;

        return $this;
    }

    public function getImageFile(): ?File
{
    return $this->imageFile;
}

public function setImageFile(?File $imageFile = null): static
{
    $this->imageFile = $imageFile;
    // Additional logic if needed
    return $this;
}


    
    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

   

   
   

    }
