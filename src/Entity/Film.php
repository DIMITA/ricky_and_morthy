<?php

namespace App\Entity;


use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\FilmRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\Length;

#[ORM\Entity(repositoryClass: FilmRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['Film:read']],
    denormalizationContext: ['groups' => ['Film:write']],
)]
#[ApiFilter(SearchFilter::class, properties: ['nom' => 'partial', 'roles.personneId.id' => 'exact', 'roles.personneId.nom' => 'exact', 'roles.personneId.prenom' => 'exact', 'roles.roleType' => 'exact',])]
class Film
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['Film:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 128)]
    #[Groups(['Film:read', 'Film:write'])]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['Film:read', 'Film:write']), Length(max: 2086)]
    private ?string $description = null;

    #[ORM\Column()]
    #[Groups(['Film:read', 'Film:write'])]
    private ?string $dateParution;

    #[ORM\OneToMany(mappedBy: 'filmId', targetEntity: Role::class, cascade: ['persist', 'remove'])]
    #[Groups(['Film:read', 'Film:write'])]
    private Collection $roles;

    public function __construct()
    {
        $this->roles = new ArrayCollection();
    }

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

    public function getDateParution(): ?string
    {
        return $this->dateParution;
    }

    public function setDateParution(string $dateParution): static
    {
        $this->dateParution = date_format(new DateTime($dateParution), 'c');
        return $this;
    }


    /**
     * @return Collection<int, Role>
     */
    public function getRoles(): Collection
    {
        return $this->roles;
    }

    public function addRole(Role $role): static
    {
        if (!$this->roles->contains($role)) {
            $this->roles->add($role);
            $role->setFilmId($this);
        }

        return $this;
    }

    public function removeRole(Role $role): static
    {
        if ($this->roles->removeElement($role)) {
            // set the owning side to null (unless already changed)
            if ($role->getFilmId() === $this) {
                $role->setFilmId(null);
            }
        }

        return $this;
    }
}
