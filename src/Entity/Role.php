<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Enums\RoleType;
use App\Repository\RoleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoleRepository::class)]
#[ApiResource]
class Role
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?RoleType $roleType = null;

    #[ORM\ManyToOne(inversedBy: 'roles')]
    private ?Personne $personneId = null;

    #[ORM\ManyToOne(inversedBy: 'roles')]
    private ?Film $filmId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoleType(): ?string
    {
        return $this->roleType;
    }

    public function setRoleType(string $roleType): static
    {
        $this->roleType = $roleType;

        return $this;
    }

    public function getPersonneId(): ?Personne
    {
        return $this->personneId;
    }

    public function setPersonneId(?Personne $personneId): static
    {
        $this->personneId = $personneId;

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
