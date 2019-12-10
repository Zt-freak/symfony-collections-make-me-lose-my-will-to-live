<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParentClassRepository")
 */
class ParentClass
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ChildClass", mappedBy="ParentClass")
     */
    private $childClasses;

    public function __construct()
    {
        $this->childClasses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function __toString()
    {
        return (string) $this->getName();
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function addChild(ChildClass $child)
    {
        $this->childClasses->add($child);
    }

    public function removeChild(ChildClass $child)
    {
        $this->childClasses->remove($child);
    }

    /**
     * @return Collection|ChildClass[]
     */
    public function getChildClasses(): Collection
    {
        return $this->childClasses;
    }

    public function addChildClass(ChildClass $childClass): self
    {
        if (!$this->childClasses->contains($childClass)) {
            $this->childClasses[] = $childClass;
            $childClass->setParentClass($this);
        }

        return $this;
    }

    public function removeChildClass(ChildClass $childClass): self
    {
        if ($this->childClasses->contains($childClass)) {
            $this->childClasses->removeElement($childClass);
            // set the owning side to null (unless already changed)
            if ($childClass->getParentClass() === $this) {
                $childClass->setParentClass(null);
            }
        }

        return $this;
    }
}
