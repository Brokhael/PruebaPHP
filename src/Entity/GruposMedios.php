<?php

namespace App\Entity;

use App\Repository\GruposMediosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GruposMediosRepository::class)
 */
class GruposMedios
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Medios::class, inversedBy="gruposMedios")
     */
    private $idMedio;

    /**
     * @ORM\ManyToOne(targetEntity=Conciertos::class, inversedBy="gruposMedios")
     */
    private $idConcierto;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdMedio(): ?Medios
    {
        return $this->idMedio;
    }

    public function setIdMedio(?Medios $idMedio): self
    {
        $this->idMedio = $idMedio;

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
