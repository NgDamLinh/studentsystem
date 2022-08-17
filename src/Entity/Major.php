<?php

namespace App\Entity;

use App\Repository\MajorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MajorRepository::class)]
class Major
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $MajorName;

    #[ORM\OneToMany(mappedBy: 'major', targetEntity: Subject::class)]
    private $Subject_ID;

    public function __construct()
    {
        $this->Subject_ID = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMajorName(): ?string
    {
        return $this->MajorName;
    }

    public function setMajorName(string $MajorName): self
    {
        $this->MajorName = $MajorName;

        return $this;
    }

    /**
     * @return Collection<int, Subject>
     */
    public function getSubjectID(): Collection
    {
        return $this->Subject_ID;
    }

    public function addSubjectID(Subject $subjectID): self
    {
        if (!$this->Subject_ID->contains($subjectID)) {
            $this->Subject_ID[] = $subjectID;
            $subjectID->setMajor($this);
        }

        return $this;
    }

    public function removeSubjectID(Subject $subjectID): self
    {
        if ($this->Subject_ID->removeElement($subjectID)) {
            // set the owning side to null (unless already changed)
            if ($subjectID->getMajor() === $this) {
                $subjectID->setMajor(null);
            }
        }

        return $this;
    }
}
