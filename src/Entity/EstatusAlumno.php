<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EstatusAlumno
 *
 * @ORM\Table(name="estatus_alumno")
 * @ORM\Entity
 */
class EstatusAlumno
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_estatus_alumno", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEstatusAlumno;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_estatus_alumno", type="string", length=50, nullable=false)
     */
    private $nombreEstatusAlumno;

    public function getIdEstatusAlumno(): ?int
    {
        return $this->idEstatusAlumno;
    }

    public function getNombreEstatusAlumno(): ?string
    {
        return $this->nombreEstatusAlumno;
    }

    public function setNombreEstatusAlumno(string $nombreEstatusAlumno): self
    {
        $this->nombreEstatusAlumno = $nombreEstatusAlumno;

        return $this;
    }


}
