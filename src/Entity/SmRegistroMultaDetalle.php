<?php

namespace App\Entity;

use App\Repository\SmRegistroMultaDetalleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SmRegistroMultaDetalleRepository")
 * 
 */
class SmRegistroMultaDetalle
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $fechaAplicacion;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $observacion;

    /**
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $estado;

    /**
     * @ORM\ManyToOne(targetEntity=SmPersona::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $smPersona;

    /**
     * @ORM\ManyToOne(targetEntity=SmTipoMulta::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $smTipoMulta;

    
    
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SmRegistroMulta", inversedBy="smRegistroMultaDetalles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $smRegistroMulta;



    /**
     * @ORM\Column(type="string", length=1)
     */
    private $pagado;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechaAplicacion(): ?\DateTimeInterface
    {
        return $this->fechaAplicacion;
    }

    public function setFechaAplicacion(\DateTimeInterface $fechaAplicacion): self
    {
        $this->fechaAplicacion = $fechaAplicacion;

        return $this;
    }

    public function getObservacion(): ?string
    {
        return $this->observacion;
    }

    public function setObservacion(string $observacion): self
    {
        $this->observacion = $observacion;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(?string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function getSmPersona(): ?SmPersona
    {
        return $this->smPersona;
    }

    public function setSmPersona(?SmPersona $smPersona): self
    {
        $this->smPersona = $smPersona;

        return $this;
    }

    public function getSmTipoMulta(): ?SmTipoMulta
    {
        return $this->smTipoMulta;
    }

    public function setSmTipoMulta(?SmTipoMulta $smTipoMulta): self
    {
        $this->smTipoMulta = $smTipoMulta;

        return $this;
    }

    public function getSmRegistroMulta(): ?SmRegistroMulta
    {
        return $this->smRegistroMulta;
    }

    public function setSmRegistroMulta(?SmRegistroMulta $smRegistroMulta): self
    {
        $this->smRegistroMulta = $smRegistroMulta;

        return $this;
    }


    public function getPagado(): ?string
    {
        return $this->pagado;
    }

    public function setPagado(string $pagado): self
    {
        $this->pagado = $pagado;

        return $this;
    }


     # Getter Personalizado para Mostrar el valor del tipo de multa

     public function getValorMulta(): ?float
     {
         $valor = 0.00;
         if($this -> getSmTipoMulta() != null){
             $valor = $this -> getSmTipoMulta() -> getValor() ;
         }
         return $valor;
     }

}
