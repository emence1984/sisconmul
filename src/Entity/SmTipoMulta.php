<?php

namespace App\Entity;

use App\Repository\SmTipoMultaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SmTipoMultaRepository")
 */
class SmTipoMulta
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
    private $descripcion;

   /**
     * @ORM\Column(type="float", length=15)
     */
    private $valor;


     /**
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $estado;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }


    public function getValor(): ?float
    {
        return $this->valor;
    }

    public function setValor(float $valor): self
    {
        $this->valor = $valor;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }


    public function __toString() {
        return $this->getDescripcion();
    }


    /*public function getValorTexto(): ?string
    {
        $valorTexto = money_format('%.2n', $this->valor);
        return $valorTexto;  //$this->valor->money_format('99999,99', $this->valor);
    }*/


}
