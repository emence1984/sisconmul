<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SmRegistroMultaRepository")
 */
class SmRegistroMulta
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
    private $fechaRegistro;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $detalle;

    /**
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $estado;

    /**
     * @ORM\ManyToOne(targetEntity=SmUsuario::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $smUsuario;



    #### detalle de multas ##########################

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SmRegistroMultaDetalle", mappedBy="smRegistroMulta",  cascade={"all"})
     * 
     * 
     */
    private $smRegistroMultaDetalles;

    public function __construct()
    {
        $this->smRegistroMultaDetalles = new ArrayCollection();
        $this->fechaRegistro = new \DateTime();
    }

    /**
     * @return Collection|SmRegistroMultaDetalle[]
     */
    public function getSmRegistroMultaDetalles(): Collection
    {
        return $this->smRegistroMultaDetalles;
    }



    public function addSmRegistroMultaDetalle(SmRegistroMultaDetalle $smRegistroMultaDetalle): self
    {
        if (!$this->smRegistroMultaDetalles->contains($smRegistroMultaDetalle)) {
            $this->smRegistroMultaDetalles[] = $smRegistroMultaDetalle;
            $smRegistroMultaDetalle->setSmRegistroMulta($this);
        }
        return $this;
    }


    public function removeSmRegistroMultaDetalle(SmRegistroMultaDetalle $smRegistroMultaDetalle): self
    {
        if ($this->smRegistroMultaDetalles->contains($smRegistroMultaDetalle)) {
            $this->smRegistroMultaDetalles->removeElement($smRegistroMultaDetalle);
            // set the owning side to null (unless already changed)
            if ($smRegistroMultaDetalle->getSmRegistroMulta() === $this) {
                $smRegistroMultaDetalle->setEstado('X');
            }
        }
        return $this;
    }



    ########################################




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechaRegistro(): ?\DateTimeInterface
    {
        return $this->fechaRegistro;
    }

    public function setFechaRegistro(\DateTimeInterface $fechaRegistro): self
    {
        $this->fechaRegistro = $fechaRegistro;

        return $this;
    }

    public function getDetalle(): ?string
    {
        return $this->detalle;
    }

    public function setDetalle(string $detalle): self
    {
        $this->detalle = $detalle;

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

    public function getSmUsuario(): ?SmUsuario
    {
        return $this->smUsuario;
    }

    public function setSmUsuario(?SmUsuario $smUsuario): self
    {
        $this->smUsuario = $smUsuario;

        return $this;
    }



     # Getter Personalizado para Mostrar el Nombre del usuario que registro la multa

     public function getNombreUsuario(): ?string
     {
         $usuario ="";
         if($this -> getSmUsuario() != null){
             $usuario = $this -> getSmUsuario()-> getUsuario() ;
         }
         return $usuario;
     }
 


     public function getValorTotalMulta(): ?float
     {
         $total =0;

         if($this -> getSmRegistroMultaDetalles() != null){
            
            foreach($this -> getSmRegistroMultaDetalles() as $detalle){
               // if($detalle->getEstado()==null){
                    $total = $total + $detalle->getSmTipoMulta()->getValor();
               // }                
             }
         }
         return $total;
     }



     public function getCantidadlMultaNoPagada(): ?float
     {
         $total =0;

         if($this -> getSmRegistroMultaDetalles() != null){
            
            foreach($this -> getSmRegistroMultaDetalles() as $detalle){
               // if($detalle->getEstado()==null){ 
                    if($detalle->getPagado()=='N'){
                        $total = $total + 1;
                    }
              //  }                
            }
         }
         return $total;
     }


     public function getValorTotalMultaPorCobrar(): ?float
     {
         $total =0;
         $totalPagado =0;

         if($this -> getSmRegistroMultaDetalles() != null){
            
            foreach($this -> getSmRegistroMultaDetalles() as $detalle){
                
              //  if($detalle->getEstado()==null){ 
                    $total = $total + $detalle -> getSmTipoMulta() -> getValor();

                    if($detalle->getPagado()=='S'){
                        $totalPagado = $totalPagado + $detalle -> getSmTipoMulta() -> getValor();
                    }                
              //  }
            }
         }
         return $total - $totalPagado;
     }


    


     public function getFechaRegistroTexto(): ?string
     {
         $fecha ="";
         if($this -> fechaRegistro != null){
            $fecha = $this -> fechaRegistro ->format('d/m/Y');  
         }
         return $fecha;
     }

}
