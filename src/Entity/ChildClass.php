<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ChildClassRepository")
 */
class ChildClass
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
     * @ORM\ManyToOne(targetEntity="App\Entity\ParentClass", inversedBy="childClasses")
     */
    private $ParentClass;

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

    public function getParentClass(): ?ParentClass
    {
        return $this->ParentClass;
    }

    public function setParentClass(?ParentClass $ParentClass): self
    {
        $this->ParentClass = $ParentClass;

        return $this;
    }
}
