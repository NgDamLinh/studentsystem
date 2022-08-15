<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudentRepository::class)]
class Student
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $stuId;

    #[ORM\Column(type: 'string', length: 255)]
    private $Name;

    #[ORM\Column(type: 'date')]
    private $DOB;

    #[ORM\Column(type: 'string', length: 255)]
    private $Sex;

    #[ORM\Column(type: 'string', length: 255)]
    private $Address;

    #[ORM\Column(type: 'string', length: 255)]
    private $Image;

    #[ORM\ManyToOne(targetEntity: Classes::class, inversedBy: 'students')]
    private $classId;

    #[ORM\OneToMany(mappedBy: 'student', targetEntity: Mark::class)]
    private $Mark;

    public function __construct()
    {
        $this->Mark = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStuId(): ?int
    {
        return $this->stuId;
    }

    public function setStuId(int $stuId): self
    {
        $this->stuId = $stuId;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

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

    public function getSex(): ?string
    {
        return $this->Sex;
    }

    public function setSex(string $Sex): self
    {
        $this->Sex = $Sex;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->Address;
    }

    public function setAddress(string $Address): self
    {
        $this->Address = $Address;

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

    public function getClassId(): ?Classes
    {
        return $this->classId;
    }

    public function setClassId(?Classes $classId): self
    {
        $this->classId = $classId;

        return $this;
    }

    /**
     * @return Collection<int, Mark>
     */
    public function getMark(): Collection
    {
        return $this->Mark;
    }

    public function addMark(Mark $mark): self
    {
        if (!$this->Mark->contains($mark)) {
            $this->Mark[] = $mark;
            $mark->setStudent($this);
        }

        return $this;
    }

    public function removeMark(Mark $mark): self
    {
        if ($this->Mark->removeElement($mark)) {
            // set the owning side to null (unless already changed)
            if ($mark->getStudent() === $this) {
                $mark->setStudent(null);
            }
        }

        return $this;
    }
}
