<?php

namespace App\Entity;

use App\Repository\FollowsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FollowsRepository::class)]
class Follows
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'follows')]
    private ?Users $follower = null;

    #[ORM\ManyToOne(inversedBy: 'follows')]
    private ?users $following = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFollower(): ?Users
    {
        return $this->follower;
    }

    public function setFollower(?Users $follower): self
    {
        $this->follower = $follower;

        return $this;
    }

    public function getFollowing(): ?users
    {
        return $this->following;
    }

    public function setFollowing(?users $following): self
    {
        $this->following = $following;

        return $this;
    }
}
