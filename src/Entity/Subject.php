<?php

namespace App\Entity;

use App\Repository\SubjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubjectRepository::class)]
class Subject
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Name;

    #[ORM\Column(type: 'string', length: 255)]
    private $Image;

    #[ORM\ManyToMany(targetEntity: Lecturer::class, mappedBy: 'SubjLec')]
    private $lecturers;

    #[ORM\OneToMany(mappedBy: 'subject', targetEntity: Mark::class)]
    private $marks;

    public function __construct()
    {
        $this->lecturers = new ArrayCollection();
        $this->marks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
     * @return Collection<int, Lecturer>
     */
    public function getLecturers(): Collection
    {
        return $this->lecturers;
    }

    public function addLecturer(Lecturer $lecturer): self
    {
        if (!$this->lecturers->contains($lecturer)) {
            $this->lecturers[] = $lecturer;
            $lecturer->addSubjLec($this);
        }

        return $this;
    }

    public function removeLecturer(Lecturer $lecturer): self
    {
        if ($this->lecturers->removeElement($lecturer)) {
            $lecturer->removeSubjLec($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Mark>
     */
    public function getMarks(): Collection
    {
        return $this->marks;
    }

    public function addMark(Mark $mark): self
    {
        if (!$this->marks->contains($mark)) {
            $this->marks[] = $mark;
            $mark->setSubject($this);
        }

        return $this;
    }

    public function removeMark(Mark $mark): self
    {
        if ($this->marks->removeElement($mark)) {
            // set the owning side to null (unless already changed)
            if ($mark->getSubject() === $this) {
                $mark->setSubject(null);
            }
        }

        return $this;
    }
}
