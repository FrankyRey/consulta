<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pago
 *
 * @ORM\Table(name="pago", indexes={@ORM\Index(name="fk_pago_fos_user1_idx", columns={"id_user"}), @ORM\Index(name="fk_pago_alumno1_idx", columns={"alumno_matricula"})})
 * @ORM\Entity
 */
class Pago
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_pago", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPago;

    /**
     * @var string
     *
     * @ORM\Column(name="mes", type="string", length=20, nullable=false)
     */
    private $mes;

    /**
     * @var int
     *
     * @ORM\Column(name="anio", type="integer", nullable=false)
     */
    private $anio;

    /**
     * @var string
     *
     * @ORM\Column(name="cantidad", type="decimal", precision=5, scale=2, nullable=false)
     */
    private $cantidad;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_pago", type="date", nullable=false)
     */
    private $fechaPago;

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
     * @var \FosUser
     *
     * @ORM\ManyToOne(targetEntity="FosUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     * })
     */
    private $idUser;

    public function getIdPago(): ?int
    {
        return $this->idPago;
    }

    public function getMes(): ?string
    {
        return $this->mes;
    }

    public function setMes(string $mes): self
    {
        $this->mes = $mes;

        return $this;
    }

    public function getAnio(): ?int
    {
        return $this->anio;
    }

    public function setAnio(int $anio): self
    {
        $this->anio = $anio;

        return $this;
    }

    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function setCantidad($cantidad): self
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function getFechaPago(): ?\DateTimeInterface
    {
        return $this->fechaPago;
    }

    public function setFechaPago(\DateTimeInterface $fechaPago): self
    {
        $this->fechaPago = $fechaPago;

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

    public function getIdUser(): ?FosUser
    {
        return $this->idUser;
    }

    public function setIdUser(?FosUser $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }


}
