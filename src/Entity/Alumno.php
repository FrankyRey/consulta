<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Alumno
 *
 * @ORM\Table(name="alumno", indexes={@ORM\Index(name="fk_alumno_oferta_academica1_idx", columns={"id_oferta_academica"}), @ORM\Index(name="fk_alumno_nivel_academico1_idx", columns={"id_nivel_academico"}), @ORM\Index(name="fk_alumno_fos_user1_idx", columns={"id_user"})})
 * @ORM\Entity
 */
class Alumno
{
    /**
     * @var string
     *
     * @ORM\Column(name="matricula", type="string", length=9, nullable=false)
     * @ORM\Id
     */
    private $matricula;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido_paterno", type="string", length=50, nullable=false)
     */
    private $apellidoPaterno;

    /**
     * @var string|null
     *
     * @ORM\Column(name="apellido_materno", type="string", length=50, nullable=true)
     */
    private $apellidoMaterno;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=50, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="curp", type="string", length=18, nullable=false)
     */
    private $curp;

    /**
     * @var int|null
     *
     * @ORM\Column(name="edad", type="integer", nullable=true)
     */
    private $edad;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_nacimiento", type="date", nullable=true)
     */
    private $fechaNacimiento;

    /**
     * @var string|null
     *
     * @ORM\Column(name="sexo", type="string", length=1, nullable=true)
     */
    private $sexo;

    /**
     * @var string
     *
     * @ORM\Column(name="correo_electronico", type="string", length=150, nullable=false)
     */
    private $correoElectronico;

    /**
     * @var string|null
     *
     * @ORM\Column(name="telefono_fijo", type="string", length=15, nullable=true)
     */
    private $telefonoFijo;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono_celular", type="string", length=15, nullable=false)
     */
    private $telefonoCelular;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_alta", type="date", nullable=false)
     */
    private $fechaAlta;

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
     * @var \NivelAcademico
     *
     * @ORM\ManyToOne(targetEntity="NivelAcademico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_nivel_academico", referencedColumnName="id_nivel_academico")
     * })
     */
    private $idNivelAcademico;

    /**
     * @var \OfertaAcademica
     *
     * @ORM\ManyToOne(targetEntity="OfertaAcademica")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_oferta_academica", referencedColumnName="id_oferta_academica")
     * })
     */
    private $idOfertaAcademica;

    /**
     * @var \EstatusAlumno
     *
     * @ORM\ManyToOne(targetEntity="EstatusAlumno")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estatus_alumno", referencedColumnName="id_estatus_alumno")
     * })
     */
    private $idEstatusAlumno;

    /**
     * @var \Grupo
     *
     * @ORM\ManyToOne(targetEntity="Grupo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_grupo", referencedColumnName="id_grupo")
     * })
     */
    private $idGrupo;

    public function getMatricula(): ?string
    {
        return $this->matricula;
    }

    public function setMatricula(string $matricula): self
    {
        $this->matricula = $matricula;

        return $this;
    }

    public function getApellidoPaterno(): ?string
    {
        return $this->apellidoPaterno;
    }

    public function setApellidoPaterno(string $apellidoPaterno): self
    {
        $this->apellidoPaterno = $apellidoPaterno;

        return $this;
    }

    public function getApellidoMaterno(): ?string
    {
        return $this->apellidoMaterno;
    }

    public function setApellidoMaterno(?string $apellidoMaterno): self
    {
        $this->apellidoMaterno = $apellidoMaterno;

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

    public function getCurp(): ?string
    {
        return $this->curp;
    }

    public function setCurp(string $curp): self
    {
        $this->curp = $curp;

        return $this;
    }

    public function getEdad(): ?int
    {
        return $this->edad;
    }

    public function setEdad(?int $edad): self
    {
        $this->edad = $edad;

        return $this;
    }

    public function getFechaNacimiento(): ?\DateTimeInterface
    {
        return $this->fechaNacimiento;
    }

    public function setFechaNacimiento(?\DateTimeInterface $fechaNacimiento): self
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    public function getSexo(): ?string
    {
        return $this->sexo;
    }

    public function setSexo(?string $sexo): self
    {
        $this->sexo = $sexo;

        return $this;
    }

    public function getCorreoElectronico(): ?string
    {
        return $this->correoElectronico;
    }

    public function setCorreoElectronico(string $correoElectronico): self
    {
        $this->correoElectronico = $correoElectronico;

        return $this;
    }

    public function getTelefonoFijo(): ?string
    {
        return $this->telefonoFijo;
    }

    public function setTelefonoFijo(?string $telefonoFijo): self
    {
        $this->telefonoFijo = $telefonoFijo;

        return $this;
    }

    public function getTelefonoCelular(): ?string
    {
        return $this->telefonoCelular;
    }

    public function setTelefonoCelular(string $telefonoCelular): self
    {
        $this->telefonoCelular = $telefonoCelular;

        return $this;
    }

    public function getFechaAlta(): ?\DateTimeInterface
    {
        return $this->fechaAlta;
    }

    public function setFechaAlta(\DateTimeInterface $fechaAlta): self
    {
        $this->fechaAlta = $fechaAlta;

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

    public function getIdNivelAcademico(): ?NivelAcademico
    {
        return $this->idNivelAcademico;
    }

    public function setIdNivelAcademico(?NivelAcademico $idNivelAcademico): self
    {
        $this->idNivelAcademico = $idNivelAcademico;

        return $this;
    }

    public function getIdOfertaAcademica(): ?OfertaAcademica
    {
        return $this->idOfertaAcademica;
    }

    public function setIdOfertaAcademica(?OfertaAcademica $idOfertaAcademica): self
    {
        $this->idOfertaAcademica = $idOfertaAcademica;

        return $this;
    }

    public function getIdEstatusAlumno(): ?EstatusAlumno
    {
        return $this->idEstatusAlumno;
    }

    public function setIdEstatusAlumno(?EstatusAlumno $idEstatusAlumno): self
    {
        $this->idEstatusAlumno = $idEstatusAlumno;

        return $this;
    }

    public function getNombreCompleto(): ?string
    {
        return $this->apellidoPaterno.' '.$this->apellidoMaterno.' '.$this->nombre;
    }

    public function getIdGrupo(): ?Grupo
    {
        return $this->idGrupo;
    }

    public function setIdGrupo(?Grupo $idGrupo): self
    {
        $this->idGrupo = $idGrupo;

        return $this;
    }


}
