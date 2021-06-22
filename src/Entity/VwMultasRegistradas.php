<?php

namespace App\Entity;

use App\Repository\VwMultasRegistradasRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Entity\VwMultasRegistradasRepository")
 */
class VwMultasRegistradas
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $detalle;

    /**
     * @ORM\Column(type="integer")
     */
    private $idRegistroMultaDetalle;

    /**
     * @ORM\Column(type="integer")
     */
    private $idRegistroMulta;

    /**
     * @ORM\Column(type="date")
     */
    private $fechaAplicacion;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $observacion;

    /**
     * @ORM\Column(type="integer")
     */
    private $smPersonaId;

    /**
     * @ORM\Column(type="integer")
     */
    private $smTipoMultaId;

    /**
     * @ORM\Column(type="string", length=13)
     */
    private $identificacion;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $apellido;

    /**
     * @ORM\Column(type="string", length=511)
     */
    private $nombreCompleto;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tipoMulta;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $valor;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $usuarioRegistro;

    /**
     * @ORM\Column(type="date")
     */
    private $fechaRegistro;


    /**
     * @ORM\Column(type="string", length=2)
     */
    private $pagado;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDetalle(): ?string
    {
        return $this->detalle;
    }

    public function setDetalle(?string $detalle): self
    {
        $this->detalle = $detalle;

        return $this;
    }

    public function getIdRegistroMultaDetalle(): ?int
    {
        return $this->idRegistroMultaDetalle;
    }

    public function setIdRegistroMultaDetalle(int $id_registro_multa_detalle): self
    {
        $this->idRegistroMultaDetalle = $id_registro_multa_detalle;

        return $this;
    }

    public function getIdRegistroMulta(): ?int
    {
        return $this->idRegistroMulta;
    }

    public function setIdRegistroMulta(int $id_registro_multa): self
    {
        $this->idRegistroMulta = $id_registro_multa;

        return $this;
    }

    public function getFechaAplicacion(): ?\DateTimeInterface
    {
        return $this->fechaAplicacion;
    }

    public function setFechaAplicacion(\DateTimeInterface $fecha_aplicacion): self
    {
        $this->fechaAplicacion = $fecha_aplicacion;

        return $this;
    }

    public function getObservacion(): ?string
    {
        return $this->observacion;
    }

    public function setObservacion(?string $observacion): self
    {
        $this->observacion = $observacion;

        return $this;
    }

    public function getSmPersonaId(): ?int
    {
        return $this->smPersonaId;
    }

    public function setSmPersonaId(int $sm_persona_id): self
    {
        $this->smPersonaId = $sm_persona_id;

        return $this;
    }

    public function getSmTipoMultaId(): ?int
    {
        return $this->smTipoMultaId;
    }

    public function setSmTipoMultaId(int $sm_tipo_multa_id): self
    {
        $this->smTipoMultaId = $sm_tipo_multa_id;

        return $this;
    }

    public function getIdentificacion(): ?string
    {
        return $this->identificacion;
    }

    public function setIdentificacion(string $identificacion): self
    {
        $this->identificacion = $identificacion;

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

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(string $apellido): self
    {
        $this->apellido = $apellido;

        return $this;
    }

    public function getNombreCompleto(): ?string
    {
        return $this->nombreCompleto;
    }

    public function setNombreCompleto(string $nombre_completo): self
    {
        $this->nombreCompleto = $nombre_completo;

        return $this;
    }

    public function getTipoMulta(): ?string
    {
        return $this->tipoMulta;
    }

    public function setTipoMulta(string $tipo_multa): self
    {
        $this->tipoMulta = $tipo_multa;

        return $this;
    }

    public function getValor(): ?float
    {
        return $this->valor;
    }

    public function setValor(?float $valor): self
    {
        $this->valor = $valor;

        return $this;
    }

    public function getUsuarioRegistro(): ?string
    {
        return $this->usuarioRegistro;
    }

    public function setUsuarioRegistro(string $usuario_registro): self
    {
        $this->usuarioRegistro = $usuario_registro;

        return $this;
    }

    public function getFechaRegistro(): ?\DateTimeInterface
    {
        return $this->fechaRegistro;
    }

    public function setFechaRegistro(\DateTimeInterface $fecha_registro): self
    {
        $this->fechaRegistro = $fecha_registro;

        return $this;
    }


    public function getPagado(): ?string
    {
        return $this->pagado;
    }

    public function setPagado(?string $pagado): self
    {
        $this->pagado = $pagado;

        return $this;
    }




      /**
     * @ORM\ManyToOne(targetEntity=SmTipoMulta::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $smTipoMulta;


    public function getSmTipoMulta(): ?SmTipoMulta
    {
        return $this->smTipoMulta;
    }

    public function setSmTipoMulta(?SmTipoMulta $smTipoMulta): self
    {
        $this->smTipoMulta = $smTipoMulta;

        return $this;
    }

}
