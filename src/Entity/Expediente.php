<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Expediente
 *
 * @ORM\Table(name="expediente", indexes={@ORM\Index(name="fk_expediente_estatus_documento1_idx", columns={"id_estatus_documento"}), @ORM\Index(name="fk_expediente_fos_user1_idx", columns={"id_user"}), @ORM\Index(name="fk_expediente_documento1_idx", columns={"id_documento"}), @ORM\Index(name="fk_expediente_alumno1_idx", columns={"alumno_matricula"})})
 * @ORM\Entity
 */
class Expediente
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_expediente", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idExpediente;

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
     * @var \Documento
     *
     * @ORM\ManyToOne(targetEntity="Documento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_documento", referencedColumnName="id_codumento")
     * })
     */
    private $idDocumento;

    /**
     * @var \EstatusDocumento
     *
     * @ORM\ManyToOne(targetEntity="EstatusDocumento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estatus_documento", referencedColumnName="id_estatus_documento")
     * })
     */
    private $idEstatusDocumento;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     * })
     */
    private $idUser;

    public function getIdExpediente(): ?int
    {
        return $this->idExpediente;
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

    public function getIdDocumento(): ?Documento
    {
        return $this->idDocumento;
    }

    public function setIdDocumento(?Documento $idDocumento): self
    {
        $this->idDocumento = $idDocumento;

        return $this;
    }

    public function getIdEstatusDocumento(): ?EstatusDocumento
    {
        return $this->idEstatusDocumento;
    }

    public function setIdEstatusDocumento(?EstatusDocumento $idEstatusDocumento): self
    {
        $this->idEstatusDocumento = $idEstatusDocumento;

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


}
