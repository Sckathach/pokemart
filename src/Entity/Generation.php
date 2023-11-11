<?php

namespace App\Entity;

use App\Repository\GenerationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GenerationRepository::class)]
class Generation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $tag = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'collection', targetEntity: Plush::class)]
    private Collection $plushes;

    public function __construct()
    {
        $this->plushes = new ArrayCollection();
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

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getTag(): ?string
    {
        return $this->tag;
    }

    public function setTag(string $tag): static
    {
        $this->tag = $tag;

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

    /**
     * @return Collection<int, Plush>
     */
    public function getPlushes(): Collection
    {
        return $this->plushes;
    }

    public function addPlush(Plush $plush): static
    {
        if (!$this->plushes->contains($plush)) {
            $this->plushes->add($plush);
            $plush->setCollection($this);
        }

        return $this;
    }

    public function removePlush(Plush $plush): static
    {
        if ($this->plushes->removeElement($plush)) {
            // set the owning side to null (unless already changed)
            if ($plush->getCollection() === $this) {
                $plush->setCollection(null);
            }
        }

        return $this;
    }

    public function __toString(): String
    {
        return $this->getName();
    }
}
