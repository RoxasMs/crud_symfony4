<?php

namespace App\Entity;

use App\Repository\ProveedorRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProveedorRepository::class)
 */
class Proveedor
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
    private $Nombre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Email;

    /**
     * @ORM\Column(type="integer")
     */
    private $Telefono;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Activo;

    /**
     * @ORM\ManyToOne(targetEntity=Categoria::class, inversedBy="Proveedors")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Categoria;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Creado;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Modificado;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre(string $Nombre): self
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getTelefono(): ?int
    {
        return $this->Telefono;
    }

    public function setTelefono(int $Telefono): self
    {
        $this->Telefono = $Telefono;

        return $this;
    }

    public function getActivo(): ?bool
    {
        return $this->Activo;
    }

    public function setActivo(bool $Activo): self
    {
        $this->Activo = $Activo;

        return $this;
    }

    public function getCategoria(): ?Categoria
    {
        return $this->Categoria;
    }
    public function setCategoria(?Categoria $Categoria): self
    {
        $this->Categoria = $Categoria;

        return $this;
    }

    public function getCreado(): ?string
    {
        return $this->Creado;
    }

    public function setCreado(string $Creado): self
    {
        $this->Creado = $Creado;

        return $this;
    }

    public function getModificado(): ?string
    {
        return $this->Modificado;
    }

    public function setModificado(string $Modificado): self
    {
        $this->Modificado = $Modificado;

        return $this;
    }

}
