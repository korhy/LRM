<?php

namespace App\Entity;

use App\Repository\PersonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonRepository::class)]
class Person
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $last_name = null;

    #[ORM\Column(length: 255)]
    private ?string $first_name = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'collaborator')]
    private ?self $manager_id = null;

    /**
     * @var Collection<int, self>
     */
    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'manager_id')]
    private Collection $collaborator;

    #[ORM\ManyToOne(inversedBy: 'collaborator')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Department $department_id = null;

    #[ORM\ManyToOne(inversedBy: 'collaborator')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Position $position_id = null;

    #[ORM\Column(nullable: true)]
    private ?bool $alert_new_request = null;

    #[ORM\Column(nullable: true)]
    private ?bool $alert_on_answer = null;

    #[ORM\Column(nullable: true)]
    private ?bool $alert_befor_vacation = null;

    /**
     * @var Collection<int, Request>
     */
    #[ORM\OneToMany(targetEntity: Request::class, mappedBy: 'collaborator_id')]
    private Collection $requests;

    public function __construct()
    {
        $this->collaborator = new ArrayCollection();
        $this->requests = new ArrayCollection();
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

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): static
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): static
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getManagerId(): ?self
    {
        return $this->manager_id;
    }

    public function setManagerId(?self $manager_id): static
    {
        $this->manager_id = $manager_id;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getCollaborator(): Collection
    {
        return $this->collaborator;
    }

    public function addCollaborator(self $collaborator): static
    {
        if (!$this->collaborator->contains($collaborator)) {
            $this->collaborator->add($collaborator);
            $collaborator->setManagerId($this);
        }

        return $this;
    }

    public function removeCollaborator(self $collaborator): static
    {
        if ($this->collaborator->removeElement($collaborator)) {
            // set the owning side to null (unless already changed)
            if ($collaborator->getManagerId() === $this) {
                $collaborator->setManagerId(null);
            }
        }

        return $this;
    }

    public function getDepartmentId(): ?Department
    {
        return $this->department_id;
    }

    public function setDepartmentId(?Department $department_id): static
    {
        $this->department_id = $department_id;

        return $this;
    }

    public function getPositionId(): ?Position
    {
        return $this->position_id;
    }

    public function setPositionId(?Position $position_id): static
    {
        $this->position_id = $position_id;

        return $this;
    }

    public function isAlertNewRequest(): ?bool
    {
        return $this->alert_new_request;
    }

    public function setAlertNewRequest(?bool $alert_new_request): static
    {
        $this->alert_new_request = $alert_new_request;

        return $this;
    }

    public function isAlertOnAnswer(): ?bool
    {
        return $this->alert_on_answer;
    }

    public function setAlertOnAnswer(?bool $alert_on_answer): static
    {
        $this->alert_on_answer = $alert_on_answer;

        return $this;
    }

    public function isAlertBeforVacation(): ?bool
    {
        return $this->alert_befor_vacation;
    }

    public function setAlertBeforVacation(?bool $alert_befor_vacation): static
    {
        $this->alert_befor_vacation = $alert_befor_vacation;

        return $this;
    }

    /**
     * @return Collection<int, Request>
     */
    public function getRequests(): Collection
    {
        return $this->requests;
    }

    public function addRequest(Request $request): static
    {
        if (!$this->requests->contains($request)) {
            $this->requests->add($request);
            $request->setCollaboratorId($this);
        }

        return $this;
    }

    public function removeRequest(Request $request): static
    {
        if ($this->requests->removeElement($request)) {
            // set the owning side to null (unless already changed)
            if ($request->getCollaboratorId() === $this) {
                $request->setCollaboratorId(null);
            }
        }

        return $this;
    }
}
