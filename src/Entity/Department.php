<?php

namespace App\Entity;

use App\Repository\DepartmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DepartmentRepository::class)]
class Department
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Person>
     */
    #[ORM\OneToMany(targetEntity: Person::class, mappedBy: 'department_id')]
    private Collection $collaborator;

    public function __construct()
    {
        $this->collaborator = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Person>
     */
    public function getCollaborator(): Collection
    {
        return $this->collaborator;
    }

    public function addCollaborator(Person $collaborator): static
    {
        if (!$this->collaborator->contains($collaborator)) {
            $this->collaborator->add($collaborator);
            $collaborator->setDepartmentId($this);
        }

        return $this;
    }

    public function removeCollaborator(Person $collaborator): static
    {
        if ($this->collaborator->removeElement($collaborator)) {
            // set the owning side to null (unless already changed)
            if ($collaborator->getDepartmentId() === $this) {
                $collaborator->setDepartmentId(null);
            }
        }

        return $this;
    }
}
