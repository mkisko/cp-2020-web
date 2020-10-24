<?php

namespace App\Entity;

use App\Repository\StageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=StageRepository::class)
 */
class Stage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"progress"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"progress"})
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity=Skill::class, mappedBy="stage")
     * @Groups({"progress"})
     */
    private $skills;

    /**
     * @ORM\OneToMany(targetEntity=UserStageProgress::class, mappedBy="Stage")
     */
    private $userStageProgress;


    public function __construct()
    {
        $this->skills = new ArrayCollection();
        $this->userStageProgress = new ArrayCollection();
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
     * @return Collection|Skill[]
     */
    public function getSkills(): Collection
    {
        return $this->skills;
    }

    public function addSkill(Skill $skill): self
    {
        if (!$this->skills->contains($skill)) {
            $this->skills[] = $skill;
            $skill->setStage($this);
        }

        return $this;
    }

    public function removeSkill(Skill $skill): self
    {
        if ($this->skills->removeElement($skill)) {
            // set the owning side to null (unless already changed)
            if ($skill->getStage() === $this) {
                $skill->setStage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UserStageProgress[]
     */
    public function getUserStageProgress(): Collection
    {
        return $this->userStageProgress;
    }

    public function addUserStageProgress(UserStageProgress $userStageProgress): self
    {
        if (!$this->userStageProgress->contains($userStageProgress)) {
            $this->userStageProgress[] = $userStageProgress;
            $userStageProgress->setStage($this);
        }

        return $this;
    }

    public function removeUserStageProgress(UserStageProgress $userStageProgress): self
    {
        if ($this->userStageProgress->removeElement($userStageProgress)) {
            // set the owning side to null (unless already changed)
            if ($userStageProgress->getStage() === $this) {
                $userStageProgress->setStage(null);
            }
        }

        return $this;
    }
}
