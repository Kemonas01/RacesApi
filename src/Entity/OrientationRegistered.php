<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrientationRegisteredRepository")
 */
class OrientationRegistered
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\OrientationRace", inversedBy="registerings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $race;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\OrientationUser", inversedBy="registerings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRace(): ?OrientationRace
    {
        return $this->race;
    }

    public function setRace(?OrientationRace $race): self
    {
        $this->race = $race;

        return $this;
    }

    public function getUser(): ?OrientationUser
    {
        return $this->user;
    }

    public function setUser(?OrientationUser $user): self
    {
        $this->user = $user;

        return $this;
    }
}
