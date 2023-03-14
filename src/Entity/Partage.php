<?php

namespace App\Entity;

use App\Repository\PartageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PartageRepository::class)]
class Partage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $nb_partage = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbPartage(): ?int
    {
        return $this->nb_partage;
    }

    public function setNbPartage(int $nb_partage): self
    {
        $this->nb_partage = $nb_partage;

        return $this;
    }
}
