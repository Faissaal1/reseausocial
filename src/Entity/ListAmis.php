<?php

namespace App\Entity;

use App\Repository\ListAmisRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ListAmisRepository::class)]
class ListAmis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $username = null;

    #[ORM\Column]
    private ?int $nb_liste = null;

    #[ORM\OneToMany(mappedBy: 'id_amis', targetEntity: ListAmis::class)]
    private Collection $listAmis;

    public function __construct()
    {
        $this->listAmis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getNbListe(): ?int
    {
        return $this->nb_liste;
    }

    public function setNbListe(int $nb_liste): self
    {
        $this->nb_liste = $nb_liste;

        return $this;
    }

    /**
     * @return Collection<int, ListAmis>
     */
    public function getListAmis(): Collection
    {
        return $this->listAmis;
    }

    public function addListAmi(ListAmis $listAmi): self
    {
        if (!$this->listAmis->contains($listAmi)) {
            $this->listAmis->add($listAmi);
            $listAmi->setIdAmis($this);
        }

        return $this;
    }

    public function removeListAmi(ListAmis $listAmi): self
    {
        if ($this->listAmis->removeElement($listAmi)) {
            // set the owning side to null (unless already changed)
            if ($listAmi->getIdAmis() === $this) {
                $listAmi->setIdAmis(null);
            }
        }

        return $this;
    }
}
