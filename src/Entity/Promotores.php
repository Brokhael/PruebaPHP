<?php

namespace App\Entity;

use App\Repository\PromotoresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PromotoresRepository::class)
 */
class Promotores
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity=Conciertos::class, mappedBy="idPromotor")
     */
    private $conciertos;

    public function __construct()
    {
        $this->conciertos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * @return Collection|Conciertos[]
     */
    public function getConciertos(): ?Collection
    {
        return $this->conciertos;
    }

    public function addConcierto(Conciertos $concierto): self
    {
        if (!$this->conciertos->contains($concierto)) {
            $this->conciertos[] = $concierto;
            $concierto->setIdPromotor($this);
        }

        return $this;
    }

    public function removeConcierto(Conciertos $concierto): self
    {
        if ($this->conciertos->removeElement($concierto)) {
            // set the owning side to null (unless already changed)
            if ($concierto->getIdPromotor() === $this) {
                $concierto->setIdPromotor(null);
            }
        }

        return $this;
    }
}
