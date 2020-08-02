<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;



/**
 * @ApiResource(
 *  shortName="Race",
 *  normalizationContext={"groups"={"Race:collection:read"}},
 *  collectionOperations={"get"={"normalizationContext"}},
 *  itemOperations={"get"={"normalization_context"={"groups"={"Race:item:read"}}}},
 *  attributes={"order"={"willStartAt":"ASC","name": "ASC"}, "pagination_items_per_page"=10},
 *  
 * )
 * @ORM\Entity(repositoryClass="App\Repository\OrientationRaceRepository")
 * @ORM\Table(name="Orientation__Race")
 * @ApiFilter(OrderFilter::class, properties={"willStartAt", "name"}, arguments={"orderParameterName"="order"})
 * 
 * @ApiFilter(BooleanFilter::class, properties={"isClosed"})
 * 
 * @ApiFilter(SearchFilter::class, properties={"name": "partial"})
 */
class OrientationRace
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("Race:collection:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("Race:collection:read")
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     * @Groups("Race:item:read")
     * 
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("Race:collection:read")
     * 
     */
    private $willStartAt;

    /**
     * @ORM\Column(type="boolean")
     * @Groups("Race:collection:read")
     */
    private $isClosed;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OrientationRegistered", mappedBy="race", orphanRemoval=true)
     */
    private $registerings;

    public function __construct()
    {
        $this->registerings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getWillStartAt(): ?\DateTimeInterface
    {
        return $this->willStartAt;
    }

    public function setWillStartAt(\DateTimeInterface $willStartAt): self
    {
        $this->willStartAt = $willStartAt;

        return $this;
    }

    public function getIsClosed(): ?bool
    {
        return $this->isClosed;
    }

    public function setIsClosed(bool $isClosed): self
    {
        $this->isClosed = $isClosed;

        return $this;
    }

    /**
     * @return Collection|OrientationRegistered[]
     */
    public function getRegisterings(): Collection
    {
        return $this->registerings;
    }

    public function addRegistering(OrientationRegistered $registering): self
    {
        if (!$this->registerings->contains($registering)) {
            $this->registerings[] = $registering;
            $registering->setRace($this);
        }

        return $this;
    }

    public function removeRegistering(OrientationRegistered $registering): self
    {
        if ($this->registerings->contains($registering)) {
            $this->registerings->removeElement($registering);
            // set the owning side to null (unless already changed)
            if ($registering->getRace() === $this) {
                $registering->setRace(null);
            }
        }

        return $this;
    }
}
