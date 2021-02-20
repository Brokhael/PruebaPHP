<?php

namespace App\Entity;

use App\Repository\RecintosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RecintosRepository::class)
 */
class Recintos
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
     * @ORM\Column(type="integer")
     */
    private $costeAlquiler;

    /**
     * @ORM\Column(type="integer")
     */
    private $precioEntrada;

    /**
     * @ORM\OneToMany(targetEntity=Conciertos::class, mappedBy="idRecinto")
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

    public function getCosteAlquiler(): ?int
    {
        return $this->costeAlquiler;
    }

    public function setCosteAlquiler(int $costeAlquiler): self
    {
        $this->costeAlquiler = $costeAlquiler;

        return $this;
    }

    public function getPrecioEntrada(): ?int
    {
        return $this->precioEntrada;
    }

    public function setPrecioEntrada(int $precioEntrada): self
    {
        $this->precioEntrada = $precioEntrada;

        return $this;
    }

    /**
     * @return Collection|Conciertos[]
     */
    public function getConciertos(): Collection
    {
        return $this->conciertos;
    }

    public function addConcierto(Conciertos $concierto): self
    {
        if (!$this->conciertos->contains($concierto)) {
            $this->conciertos[] = $concierto;
            $concierto->setIdRecinto($this);
        }

        return $this;
    }

    public function removeConcierto(Conciertos $concierto): self
    {
        if ($this->conciertos->removeElement($concierto)) {
            // set the owning side to null (unless already changed)
            if ($concierto->getIdRecinto() === $this) {
                $concierto->setIdRecinto(null);
            }
        }

        return $this;
    }
}
