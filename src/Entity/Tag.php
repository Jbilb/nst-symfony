<?php

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TagRepository::class)
 */
class Tag
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Product::class, mappedBy="traces")
     */
    private $productsTraces;

    public function __construct()
    {
        $this->productsTraces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProductsTraces(): Collection
    {
        return $this->productsTraces;
    }

    public function addProductsTrace(Product $productsTrace): self
    {
        if (!$this->productsTraces->contains($productsTrace)) {
            $this->productsTraces[] = $productsTrace;
            $productsTrace->addTrace($this);
        }

        return $this;
    }

    public function removeProductsTrace(Product $productsTrace): self
    {
        if ($this->productsTraces->removeElement($productsTrace)) {
            $productsTrace->removeTrace($this);
        }

        return $this;
    }
}
