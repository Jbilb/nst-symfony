<?php

namespace App\Entity;

use App\Repository\OfferRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OfferRepository::class)
 */
class Offer
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
    private $title;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $titleVignette;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateStart;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateEnd;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $imageVignette;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $imagePhoto;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $imageDesktop;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $imageMobile;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $textButton;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $urlButton;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPublished;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isFeatured;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getTitleVignette(): ?string
    {
        return $this->titleVignette;
    }

    public function setTitleVignette(?string $titleVignette): self
    {
        $this->titleVignette = $titleVignette;

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

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->dateStart;
    }

    public function setDateStart(?\DateTimeInterface $dateStart): self
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->dateEnd;
    }

    public function setDateEnd(?\DateTimeInterface $dateEnd): self
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    public function getImageVignette(): ?string
    {
        return $this->imageVignette;
    }

    public function setImageVignette(?string $imageVignette): self
    {
        $this->imageVignette = $imageVignette;

        return $this;
    }

    public function getImagePhoto(): ?string
    {
        return $this->imagePhoto;
    }

    public function setImagePhoto(?string $imagePhoto): self
    {
        $this->imagePhoto = $imagePhoto;

        return $this;
    }

    public function getImageDesktop(): ?string
    {
        return $this->imageDesktop;
    }

    public function setImageDesktop(?string $imageDesktop): self
    {
        $this->imageDesktop = $imageDesktop;

        return $this;
    }

    public function getImageMobile(): ?string
    {
        return $this->imageMobile;
    }

    public function setImageMobile(?string $imageMobile): self
    {
        $this->imageMobile = $imageMobile;

        return $this;
    }

    public function getTextButton(): ?string
    {
        return $this->textButton;
    }

    public function setTextButton(?string $textButton): self
    {
        $this->textButton = $textButton;

        return $this;
    }

    public function getUrlButton(): ?string
    {
        return $this->urlButton;
    }

    public function setUrlButton(?string $urlButton): self
    {
        $this->urlButton = $urlButton;

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
}
