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
     * @Groups({"vacancies"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"vacancies"})
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Groups({"vacancies"})
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Skill::class, mappedBy="vacancy")
     * @Groups({"vacancies"})
     */
    private $Skill;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"vacancies"})
     */
    private $minCost;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"vacancies"})
     */
    private $maxCost;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"vacancies"})
     */
    private $typeIntern;


    /**
     * @ORM\Column(type="datetime")
     * @Groups({"vacancies"})
     */
    private $Expired;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"vacancies"})
     */
    private $PublichedAt;

    /**
     * @ORM\Column(type="text")
     * @Groups({"vacancies"})
     */
    private $conditions;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="vacancies")
     */
    private $User;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $City;

    public function __construct()
    {
        $this->Skill = new ArrayCollection();
        $this->User = new ArrayCollection();
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

    /**
     * @return Collection|Skill[]
     */
    public function getSkill(): Collection
    {
        return $this->Skill;
    }

    public function addSkill(Skill $skill): self
    {
        if (!$this->Skill->contains($skill)) {
            $this->Skill[] = $skill;
            $skill->setVacancy($this);
        }

        return $this;
    }

    public function removeSkill(Skill $skill): self
    {
        if ($this->Skill->removeElement($skill)) {
            // set the owning side to null (unless already changed)
            if ($skill->getVacancy() === $this) {
                $skill->setVacancy(null);
            }
        }

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
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

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
}
