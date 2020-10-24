<?php

namespace App\Entity;

use App\Repository\EducationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EducationRepository::class)
 */
class Education
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity=UserEducation::class, mappedBy="Education")
     */
    private $userEducation;

    public function __construct()
    {
        $this->userEducation = new ArrayCollection();
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

    /**
     * @return Collection|UserEducation[]
     */
    public function getUserEducation(): Collection
    {
        return $this->userEducation;
    }

    public function addUserEducation(UserEducation $userEducation): self
    {
        if (!$this->userEducation->contains($userEducation)) {
            $this->userEducation[] = $userEducation;
            $userEducation->setEducation($this);
        }

        return $this;
    }

    public function removeUserEducation(UserEducation $userEducation): self
    {
        if ($this->userEducation->removeElement($userEducation)) {
            // set the owning side to null (unless already changed)
            if ($userEducation->getEducation() === $this) {
                $userEducation->setEducation(null);
            }
        }

        return $this;
    }

}
