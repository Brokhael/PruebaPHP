<?php

namespace App\Entity;

use App\Repository\GruposConciertosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GruposConciertosRepository::class)
 */
class GruposConciertos
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Grupos::class, inversedBy="gruposConciertos")
     */
    private $idGrupo;

    /**
     * @ORM\ManyToOne(targetEntity=Conciertos::class, inversedBy="gruposConciertos")
     */
    private $idConcierto;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdGrupo(): ?Grupos
    {
        return $this->idGrupo;
    }

    public function setIdGrupo(?Grupos $idGrupo): self
    {
        $this->idGrupo = $idGrupo;

        return $this;
    }

    public function getIdConcierto(): ?Conciertos
    {
        return $this->idConcierto;
    }

    public function setIdConcierto(?Conciertos $idConcierto): self
    {
        $this->idConcierto = $idConcierto;

        return $this;
    }
}
