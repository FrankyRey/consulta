<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Seguimiento
 *
 * @ORM\Table(name="seguimiento", indexes={@ORM\Index(name="fk_seguimiento_alumno1_idx", columns={"alumno_matricula"}), @ORM\Index(name="fk_seguimiento_tipo_correo1_idx", columns={"tipo_correo"}), @ORM\Index(name="fk_seguimiento_fos_user1_idx", columns={"id_user"})})
 * @ORM\Entity
 */
class Seguimiento
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_seguimiento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSeguimiento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_seguimiento", type="date", nullable=false)
     */
    private $fechaSeguimiento;

    /**
     * @var \Alumno
     *
     * @ORM\ManyToOne(targetEntity="Alumno")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="alumno_matricula", referencedColumnName="matricula")
     * })
     */
    private $alumnoMatricula;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     * })
     */
    private $idUser;

    /**
     * @var \TipoCorreo
     *
     * @ORM\ManyToOne(targetEntity="TipoCorreo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipo_correo", referencedColumnName="id_tipo_correo")
     * })
     */
    private $tipoCorreo;

    public function getIdSeguimiento(): ?int
    {
        return $this->idSeguimiento;
    }

    public function getFechaSeguimiento(): ?\DateTimeInterface
    {
        return $this->fechaSeguimiento;
    }

    public function setFechaSeguimiento(\DateTimeInterface $fechaSeguimiento): self
    {
        $this->fechaSeguimiento = $fechaSeguimiento;

        return $this;
    }

    public function getAlumnoMatricula(): ?Alumno
    {
        return $this->alumnoMatricula;
    }

    public function setAlumnoMatricula(?Alumno $alumnoMatricula): self
    {
        $this->alumnoMatricula = $alumnoMatricula;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getTipoCorreo(): ?TipoCorreo
    {
        return $this->tipoCorreo;
    }

    public function setTipoCorreo(?TipoCorreo $tipoCorreo): self
    {
        $this->tipoCorreo = $tipoCorreo;

        return $this;
    }


}
