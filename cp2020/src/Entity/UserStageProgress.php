<?php

namespace App\Entity;

use App\Repository\UserStageProgressRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=UserStageProgressRepository::class)
 */
class UserStageProgress
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"progress"})
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"progress"})
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="userStageProgress")
     * @Groups({"progress"})
     */
    private $User;

    /**
     * @ORM\ManyToOne(targetEntity=Stage::class, inversedBy="userStageProgress")
     * @Groups({"progress"})
     */
    private $Stage;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

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

    public function getStage(): ?Stage
    {
        return $this->Stage;
    }

    public function setStage(?Stage $Stage): self
    {
        $this->Stage = $Stage;

        return $this;
    }
}
