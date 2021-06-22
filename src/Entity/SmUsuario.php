<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SmUsuarioRepository")
 */
class SmUsuario  implements UserInterface, \Serializable {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $usuario;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $clave;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $tipo;

    /**
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $estado;

    /**
     * @ORM\ManyToOne(targetEntity=SmPersona::class, inversedBy="smUsuarios")
     * @ORM\JoinColumn(nullable=false)
     */
    private $smPersona;



    # Campos adicionales


    private $plainPassword;

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }



    private $isActive;
    
    public function getIsActive() {
        return $this->isActive;
       }
       public function setIsActive($isActive) {
        $this->isActive = $isActive;
        return $this;
       }
    
    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function getUsername()
    {
        return $this->usuario;
    }

    public function getPassword()
    {
        return $this->clave;
    }

    public function __construct()
    {
      /*  if($this->getEstado() == null){
            $this->isActive = true;
        }else{
            $this->isActive = false;
        }*/

        $this->isActive = true;     
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid('', true));
    }

    /**
     * 
     */
    private $roles = [];

    public function getRoles()
    { 
        if ($this->getTipo() != null){
            if ($this->getTipo() == 'A'){
                return array('ROLE_ADMIN');
            }else{
                return array('ROLE_USER');
            }

        }else{
            return array('ROLE_USER');
        }

        return array('ROLE_USER');
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->usuario,
            $this->clave,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->usuario,
            $this->clave,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized); //= unserialize($serialized, array('allowed_classes' => false));
    }

    ##############


    public function __toString() {

        return  'Username: '. $this->getUsuario() .'; Persona: ' .$this -> getNombrePersona();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsuario(): ?string
    {
        return $this->usuario;
    }

    public function setUsuario(string $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getClave(): ?string
    {
        return $this->clave;
    }

    public function setClave(string $clave): self
    {
        $this->clave = $clave;

        return $this;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): self
    {
        $this->tipo = $tipo;

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

    # Getter Personalizado para Mostrar el Nombre de la Persona que esta relacionado al Usuario

    public function getNombrePersona(): ?string
    {
        $nombrePersona ="";
        if($this -> getSmPersona() != null){
            $nombrePersona = $this -> getSmPersona() -> getNombreCompleto() ;
        }
        return $nombrePersona;
    }


    #Getter para mostrar el tipo de usuario con una descripcion entendible
    public function getTipoDescripcion(): ?string
    {
        $tipoDescripcion ="";

        if($this -> getTipo() != null){
            if($this -> getTipo() == 'A'){
                $tipoDescripcion = 'Administrador del Sistema' ;
            }else{
                $tipoDescripcion = 'Usuario del Sistema' ;
            }    
           
        }
        return $tipoDescripcion;
    } 



}
