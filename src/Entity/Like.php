<?php

namespace App\Entity;

use App\Repository\LikeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LikeRepository::class)]
#[ORM\Table(name: '`like`')]
class Like
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $nb_like = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbLike(): ?int
    {
        return $this->nb_like;
    }

    public function setNbLike(int $nb_like): self
    {
        $this->nb_like = $nb_like;

        return $this;
    }
}
