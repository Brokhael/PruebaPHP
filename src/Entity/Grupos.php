<?php

namespace App\Entity;

use App\Repository\GruposRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GruposRepository::class)
 */
class Grupos
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
    private $cache;

    /**
     * @ORM\OneToMany(targetEntity=GruposConciertos::class, mappedBy="idGrupo")
     */
    private $gruposConciertos;

    public function __construct()
    {
        $this->gruposConciertos = new ArrayCollection();
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

    public function getCache(): ?int
    {
        return $this->cache;
    }

    public function setCache(int $cache): self
    {
        $this->cache = $cache;

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
            $gruposConcierto->setIdGrupo($this);
        }

        return $this;
    }

    public function removeGruposConcierto(GruposConciertos $gruposConcierto): self
    {
        if ($this->gruposConciertos->removeElement($gruposConcierto)) {
            // set the owning side to null (unless already changed)
            if ($gruposConcierto->getIdGrupo() === $this) {
                $gruposConcierto->setIdGrupo(null);
            }
        }

        return $this;
    }
}
