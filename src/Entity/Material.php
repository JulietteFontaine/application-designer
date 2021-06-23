<?php

namespace App\Entity;

use App\Repository\MaterialRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MaterialRepository::class)
 */
class Material
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Factory::class, inversedBy="materials")
     */
    private $factory;

    /**
     * @ORM\ManyToMany(targetEntity=Furniture::class, mappedBy="materials")
     */
    private $furnitures;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $type;

    public function __construct()
    {
        $this->furnitures = new ArrayCollection();
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

    public function getFactory(): ?Factory
    {
        return $this->factory;
    }

    public function setFactory(?Factory $factory): self
    {
        $this->factory = $factory;

        return $this;
    }

    /**
     * @return Collection|Furniture[]
     */
    public function getFurnitures(): Collection
    {
        return $this->furnitures;
    }

    public function addFurniture(Furniture $furniture): self
    {
        if (!$this->furnitures->contains($furniture)) {
            $this->furnitures[] = $furniture;
            $furniture->addMaterial($this);
        }

        return $this;
    }

    public function removeFurniture(Furniture $furniture): self
    {
        if ($this->furnitures->removeElement($furniture)) {
            $furniture->removeMaterial($this);
        }

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }
}
