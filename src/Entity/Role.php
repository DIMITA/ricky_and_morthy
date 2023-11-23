<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Enums\RoleType;
use App\Repository\RoleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: RoleRepository::class)]
#[ApiResource]
class Role
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    #[Groups(['Film:read', 'Film:write'])]
    private ?RoleType $roleType = null;

    #[ORM\ManyToOne(inversedBy: 'roles')]
    #[Groups(['Film:read', 'Film:write'])]
    private ?Personne $personne = null;

    #[ORM\ManyToOne(inversedBy: 'roles')]
    private ?Film $filmId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoleType(): ?RoleType
    {
        return $this->roleType;
    }

    public function setRoleType(RoleType $roleType): static
    {
        $this->roleType = $roleType;

        return $this;
    }

    public function getPersonne(): ?Personne
    {
        return $this->personne;
    }

    public function setPersonne(?Personne $personne): static
    {
        $this->personne = $personne;

        return $this;
    }

    public function getFilmId(): ?Film
    {
        return $this->filmId;
    }

    public function setFilmId(?Film $filmId): static
    {
        $this->filmId = $filmId;

        return $this;
    }
}
