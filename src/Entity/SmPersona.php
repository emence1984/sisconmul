<?php

namespace App\Entity;

use App\Repository\SmPersonaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SmPersonaRepository")
 */
class SmPersona
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
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
     * @ORM\Column(type="string", length=50)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $telefono;

    /**
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $estado;

    public function __toString() {
        return $this->getNombreCompleto();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function setNOmbre(string $nombre): self
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


    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

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

    public function SmPersona(string $nombre, string $apellido): self
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;

        return $this;
    }


/**
 * Getter Personalizado
 */
    public function getNombreCompleto(): ?string
    {
        $nombreCompleto ="";

        if($this -> getApellido() != null){
            $nombreCompleto = $nombreCompleto .  $this -> getApellido() ;
        }

        if($this -> getNombre() != null){
            $nombreCompleto = $nombreCompleto .' ' .$this -> getNombre() ;
        }

        return $nombreCompleto ;
    }

}
