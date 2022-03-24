<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=Tag::class, inversedBy="productsTraces")
     */
    private $traces;

    /**
     * @ORM\OneToMany(targetEntity=Image::class, mappedBy="product")
     */
    private $photos;

    /**
     * @ORM\ManyToMany(targetEntity=Choice::class, inversedBy="products")
     */
    private $choices;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPublished;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isFeatured;

    /**
     * @ORM\ManyToMany(targetEntity=Allergen::class, inversedBy="products")
     */
    private $allergen;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $vignette;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isCurrentProduct;

    public function __construct()
    {
        $this->traces = new ArrayCollection();
        $this->photos = new ArrayCollection();
        $this->choices = new ArrayCollection();
        $this->allergen = new ArrayCollection();
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

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTraces(): Collection
    {
        return $this->traces;
    }

    public function addTrace(Tag $trace): self
    {
        if (!$this->traces->contains($trace)) {
            $this->traces[] = $trace;
        }

        return $this;
    }

    public function removeTrace(Tag $trace): self
    {
        $this->traces->removeElement($trace);

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(Image $photo): self
    {
        if (!$this->photos->contains($photo)) {
            $this->photos[] = $photo;
            $photo->setProduct($this);
        }

        return $this;
    }

    public function removePhoto(Image $photo): self
    {
        if ($this->photos->removeElement($photo)) {
            // set the owning side to null (unless already changed)
            if ($photo->getProduct() === $this) {
                $photo->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Choice>
     */
    public function getChoices(): Collection
    {
        return $this->choices;
    }

    public function addChoice(Choice $choice): self
    {
        if (!$this->choices->contains($choice)) {
            $this->choices[] = $choice;
        }

        return $this;
    }

    public function removeChoice(Choice $choice): self
    {
        $this->choices->removeElement($choice);

        return $this;
    }

    public function getIsPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function setIsPublished(bool $isPublished): self
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    public function getIsFeatured(): ?bool
    {
        return $this->isFeatured;
    }

    public function setIsFeatured(bool $isFeatured): self
    {
        $this->isFeatured = $isFeatured;

        return $this;
    }

    /**
     * @return Collection<int, Allergen>
     */
    public function getAllergen(): Collection
    {
        return $this->allergen;
    }

    public function addAllergen(Allergen $allergen): self
    {
        if (!$this->allergen->contains($allergen)) {
            $this->allergen[] = $allergen;
        }

        return $this;
    }

    public function removeAllergen(Allergen $allergen): self
    {
        $this->allergen->removeElement($allergen);

        return $this;
    }

    public function getVignette(): ?string
    {
        return $this->vignette;
    }

    public function setVignette(?string $vignette): self
    {
        $this->vignette = $vignette;

        return $this;
    }

    public function getIsCurrentProduct(): ?bool
    {
        return $this->isCurrentProduct;
    }

    public function setIsCurrentProduct(bool $isCurrentProduct): self
    {
        $this->isCurrentProduct = $isCurrentProduct;

        return $this;
    }
}
