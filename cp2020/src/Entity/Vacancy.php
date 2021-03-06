<?php

namespace App\Entity;

use App\Repository\VacancyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=VacancyRepository::class)
 */
class Vacancy
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"vacancies", "companies"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"vacancies", "companies"})
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Groups({"vacancies", "companies"})
     */
    private $description;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"vacancies", "companies"})
     */
    private $minCost;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"vacancies", "companies"})
     */
    private $maxCost;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"vacancies", "companies"})
     */
    private $typeIntern;


    /**
     * @ORM\Column(type="datetime")
     * @Groups({"vacancies", "companies"})
     */
    private $Expired;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"vacancies", "companies"})
     */
    private $PublichedAt;

    /**
     * @ORM\Column(type="text")
     * @Groups({"vacancies", "companies"})
     */
    private $conditions;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="vacancies")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"vacancies", "companies"})
     */
    private $City;

    /**
     * @ORM\ManyToMany(targetEntity=Skill::class, inversedBy="vacancies")
     * @Groups({"vacancies", "companies"})
     */
    private $Skills;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class, inversedBy="vacancies")
     */
    private $company;


    public function __construct()
    {
        $this->setExpired(new \DateTime(2020-11-25));
        $this->setPublichedAt(new \DateTime(2020-11-25));
        $this->User = new ArrayCollection();
        $this->Skills = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }


    public function getMinCost(): ?int
    {
        return $this->minCost;
    }

    public function setMinCost(?int $minCost): self
    {
        $this->minCost = $minCost;

        return $this;
    }

    public function getMaxCost(): ?int
    {
        return $this->maxCost;
    }

    public function setMaxCost(?int $maxCost): self
    {
        $this->maxCost = $maxCost;

        return $this;
    }

    public function getTypeIntern(): ?int
    {
        return $this->typeIntern;
    }

    public function setTypeIntern(?int $typeIntern): self
    {
        $this->typeIntern = $typeIntern;

        return $this;
    }


    public function getExpired(): ?\DateTimeInterface
    {
        return $this->Expired;
    }

    public function setExpired(\DateTimeInterface $Expired): self
    {
        $this->Expired = $Expired;

        return $this;
    }

    public function getPublichedAt(): ?\DateTimeInterface
    {
        return $this->PublichedAt;
    }

    public function setPublichedAt(\DateTimeInterface $PublichedAt): self
    {
        $this->PublichedAt = $PublichedAt;

        return $this;
    }

    public function getConditions(): ?string
    {
        return $this->conditions;
    }

    public function setConditions(string $conditions): self
    {
        $this->conditions = $conditions;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $User): self
    {
        $this->user = $User;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->City;
    }

    public function setCity(string $City): self
    {
        $this->City = $City;

        return $this;
    }

    /**
     * @return Collection|Skill[]
     */
    public function getSkills(): Collection
    {
        return $this->Skills;
    }

    public function addSkill(Skill $skill): self
    {
        if (!$this->Skills->contains($skill)) {
            $this->Skills[] = $skill;
        }

        return $this;
    }

    public function removeSkill(Skill $skill): self
    {
        $this->Skills->removeElement($skill);

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }
}
