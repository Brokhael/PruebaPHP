<?php

namespace App\Entity;

use App\Repository\ConciertosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConciertosRepository::class)
 */
class Conciertos
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Promotores::class, inversedBy="conciertos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idPromotor;

    /**
     * @ORM\ManyToOne(targetEntity=Recintos::class, inversedBy="conciertos")
     */
    private $idRecinto;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\Column(type="integer")
     */
    private $numeroEspectadores;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha;

    /**
     * @ORM\Column(type="integer")
     */
    private $rentabilidad;

    /**
     * @ORM\OneToMany(targetEntity=GruposConciertos::class, mappedBy="idConcierto")
     */
    private $gruposConciertos;

    /**
     * @ORM\OneToMany(targetEntity=GruposMedios::class, mappedBy="idConcierto")
     */
    private $gruposMedios;

    public function __construct()
    {
        $this->gruposConciertos = new ArrayCollection();
        $this->gruposMedios = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdPromotor(): ?Promotores
    {
        return $this->idPromotor;
    }

    public function setIdPromotor(?Promotores $idPromotor): self
    {
        $this->idPromotor = $idPromotor;

        return $this;
    }

    public function getIdRecinto(): ?Recintos
    {
        return $this->idRecinto;
    }

    public function setIdRecinto(?Recintos $idRecinto): self
    {
        $this->idRecinto = $idRecinto;

        return $this;
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

    public function getNumeroEspectadores(): ?int
    {
        return $this->numeroEspectadores;
    }

    public function setNumeroEspectadores(int $numeroEspectadores): self
    {
        $this->numeroEspectadores = $numeroEspectadores;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getRentabilidad(): ?int
    {
        return $this->rentabilidad;
    }

    public function setRentabilidad(int $rentabilidad): self
    {
        $this->rentabilidad = $rentabilidad;

        return $this;
    }

    /**
     * @return Collection|GruposConciertos[]
     */
    public function getGruposConciertos(): Collection
    {
        return $this->gruposConciertos;
    }

    public function addGruposConcierto(GruposConciertos $gruposConcierto): self
    {
        if (!$this->gruposConciertos->contains($gruposConcierto)) {
            $this->gruposConciertos[] = $gruposConcierto;
            $gruposConcierto->setIdConcierto($this);
        }

        return $this;
    }

    public function removeGruposConcierto(GruposConciertos $gruposConcierto): self
    {
        if ($this->gruposConciertos->removeElement($gruposConcierto)) {
            // set the owning side to null (unless already changed)
            if ($gruposConcierto->getIdConcierto() === $this) {
                $gruposConcierto->setIdConcierto(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|GruposMedios[]
     */
    public function getGruposMedios(): Collection
    {
        return $this->gruposMedios;
    }

    public function addGruposMedio(GruposMedios $gruposMedio): self
    {
        if (!$this->gruposMedios->contains($gruposMedio)) {
            $this->gruposMedios[] = $gruposMedio;
            $gruposMedio->setIdConcierto($this);
        }

        return $this;
    }

    public function removeGruposMedio(GruposMedios $gruposMedio): self
    {
        if ($this->gruposMedios->removeElement($gruposMedio)) {
            // set the owning side to null (unless already changed)
            if ($gruposMedio->getIdConcierto() === $this) {
                $gruposMedio->setIdConcierto(null);
            }
        }

        return $this;
    }
}
