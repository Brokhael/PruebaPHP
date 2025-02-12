<?php

namespace App\Entity;

use App\Repository\MediosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MediosRepository::class)
 */
class Medios
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
     * @ORM\OneToMany(targetEntity=GruposMedios::class, mappedBy="idMedio")
     */
    private $gruposMedios;

    public function __construct()
    {
        $this->gruposMedios = new ArrayCollection();
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
            $gruposMedio->setIdMedio($this);
        }

        return $this;
    }

    public function removeGruposMedio(GruposMedios $gruposMedio): self
    {
        if ($this->gruposMedios->removeElement($gruposMedio)) {
            // set the owning side to null (unless already changed)
            if ($gruposMedio->getIdMedio() === $this) {
                $gruposMedio->setIdMedio(null);
            }
        }

        return $this;
    }
}
