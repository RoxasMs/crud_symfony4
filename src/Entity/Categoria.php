<?php

namespace App\Entity;

use App\Repository\CategoriaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoriaRepository::class)
 */
class Categoria
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
     * @ORM\OneToMany(targetEntity=Proveedor::class, mappedBy="Category")
     */
    private $Proveedors;

    public function __construct()
    {
        $this->Proveedors = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Proveedor>
     */
    public function getProveedors(): Collection
    {
        return $this->Proveedors;
    }

    public function addProveedor(Proveedor $proveedor): self
    {
        if (!$this->Proveedors->contains($proveedor)) {
            $this->Proveedors[] = $proveedor;
            $proveedor->setCategoria($this);
        }

        return $this;
    }

    public function removeProveedor(Proveedor $proveedor): self
    {
        if ($this->Proveedors->removeElement($proveedor)) {
            // set the owning side to null (unless already changed)
            if ($proveedor->getCategoria() === $this) {
                $proveedor->setCategoria(null);
            }
        }

        return $this;
    }
}
