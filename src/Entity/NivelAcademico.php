<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NivelAcademico
 *
 * @ORM\Table(name="nivel_academico")
 * @ORM\Entity
 */
class NivelAcademico
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_nivel_academico", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idNivelAcademico;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_nivel_academico", type="string", length=100, nullable=false)
     */
    private $nombreNivelAcademico;

    public function getIdNivelAcademico(): ?int
    {
        return $this->idNivelAcademico;
    }

    public function getNombreNivelAcademico(): ?string
    {
        return $this->nombreNivelAcademico;
    }

    public function setNombreNivelAcademico(string $nombreNivelAcademico): self
    {
        $this->nombreNivelAcademico = $nombreNivelAcademico;

        return $this;
    }


}
