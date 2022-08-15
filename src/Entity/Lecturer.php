<?php

namespace App\Entity;

use App\Repository\LecturerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LecturerRepository::class)]
class Lecturer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $lecID;

    #[ORM\Column(type: 'string', length: 255)]
    private $lecName;

    #[ORM\Column(type: 'date')]
    private $DOB;

    #[ORM\Column(type: 'string', length: 255)]
    private $Image;

    #[ORM\ManyToMany(targetEntity: Subject::class, inversedBy: 'lecturers')]
    private $SubjLec;

    #[ORM\ManyToMany(targetEntity: Classes::class, inversedBy: 'lecturers')]
    private $Classes;

    public function __construct()
    {
        $this->SubjLec = new ArrayCollection();
        $this->Classes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLecID(): ?int
    {
        return $this->lecID;
    }

    public function setLecID(int $lecID): self
    {
        $this->lecID = $lecID;

        return $this;
    }

    public function getLecName(): ?string
    {
        return $this->lecName;
    }

    public function setLecName(string $lecName): self
    {
        $this->lecName = $lecName;

        return $this;
    }

    public function getDOB(): ?\DateTimeInterface
    {
        return $this->DOB;
    }

    public function setDOB(\DateTimeInterface $DOB): self
    {
        $this->DOB = $DOB;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->Image;
    }

    public function setImage(string $Image): self
    {
        $this->Image = $Image;

        return $this;
    }

    /**
     * @return Collection<int, Subject>
     */
    public function getSubjLec(): Collection
    {
        return $this->SubjLec;
    }

    public function addSubjLec(Subject $subjLec): self
    {
        if (!$this->SubjLec->contains($subjLec)) {
            $this->SubjLec[] = $subjLec;
        }

        return $this;
    }

    public function removeSubjLec(Subject $subjLec): self
    {
        $this->SubjLec->removeElement($subjLec);

        return $this;
    }

    /**
     * @return Collection<int, Classes>
     */
    public function getClasses(): Collection
    {
        return $this->Classes;
    }

    public function addClass(Classes $class): self
    {
        if (!$this->Classes->contains($class)) {
            $this->Classes[] = $class;
        }

        return $this;
    }

    public function removeClass(Classes $class): self
    {
        $this->Classes->removeElement($class);

        return $this;
    }
}
