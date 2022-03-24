<?php

namespace App\Entity;

use App\Repository\RestaurantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RestaurantRepository::class)
 */
class Restaurant
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titleContent;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $textContent;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\OneToMany(targetEntity="ImageRestaurant", mappedBy="restaurant", cascade={"persist"})
     */
    private $imageRestaurants;

    /**
     * @ORM\ManyToMany(targetEntity=Tag::class)
     */
    private $amenities;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $urlOrder;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $urlGoogle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $urlItinary;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $urlYoutube;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $buttonTitle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $urlSymbiose;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datePublishing;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPublished;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $lat;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $lng;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $timeMonday;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $timeTuesday;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $timeWenesday;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $timeThursday;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $timeFriday;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $timeSaturday;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $timeSunday;

    public function __construct()
    {
        $this->amenities = new ArrayCollection();
        $this->imageRestaurants = new ArrayCollection();
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

    public function getTitleContent(): ?string
    {
        return $this->titleContent;
    }

    public function setTitleContent(?string $titleContent): self
    {
        $this->titleContent = $titleContent;

        return $this;
    }

    public function getTextContent(): ?string
    {
        return $this->textContent;
    }

    public function setTextContent(?string $textContent): self
    {
        $this->textContent = $textContent;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Collection|ImageRestaurant[]
     */
    public function getImageRestaurants(): Collection
    {
        return $this->imageRestaurants;
    }

    public function addImageRestaurant(ImageRestaurant $imageRestaurant): self
    {
        if (!$this->imageRestaurants->contains($imageRestaurant)) {
            $this->imageRestaurants[] = $imageRestaurant;
            $imageRestaurant->setRestaurant($this);
        }

        return $this;
    }

    public function removeImageRestaurant(ImageRestaurant $imageRestaurant): self
    {
        if ($this->imageRestaurants->removeElement($imageRestaurant)) {
            // set the owning side to null (unless already changed)
            if ($imageRestaurant->getRestaurant() === $this) {
                $imageRestaurant->setRestaurant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getAmenities(): Collection
    {
        return $this->amenities;
    }

    public function addAmenity(Tag $amenity): self
    {
        if (!$this->amenities->contains($amenity)) {
            $this->amenities[] = $amenity;
        }

        return $this;
    }

    public function removeAmenity(Tag $amenity): self
    {
        $this->amenities->removeElement($amenity);

        return $this;
    }

    public function getUrlOrder(): ?string
    {
        return $this->urlOrder;
    }

    public function setUrlOrder(?string $urlOrder): self
    {
        $this->urlOrder = $urlOrder;

        return $this;
    }

    public function getUrlGoogle(): ?string
    {
        return $this->urlGoogle;
    }

    public function setUrlGoogle(?string $urlGoogle): self
    {
        $this->urlGoogle = $urlGoogle;

        return $this;
    }

    public function getUrlItinary(): ?string
    {
        return $this->urlItinary;
    }

    public function setUrlItinary(?string $urlItinary): self
    {
        $this->urlItinary = $urlItinary;

        return $this;
    }

    public function getUrlYoutube(): ?string
    {
        return $this->urlYoutube;
    }

    public function setUrlYoutube(?string $urlYoutube): self
    {
        $this->urlYoutube = $urlYoutube;

        return $this;
    }

    public function getButtonTitle(): ?string
    {
        return $this->buttonTitle;
    }

    public function setButtonTitle(?string $buttonTitle): self
    {
        $this->buttonTitle = $buttonTitle;

        return $this;
    }

    public function getUrlSymbiose(): ?string
    {
        return $this->urlSymbiose;
    }

    public function setUrlSymbiose(?string $urlSymbiose): self
    {
        $this->urlSymbiose = $urlSymbiose;

        return $this;
    }

    public function getDatePublishing(): ?\DateTimeInterface
    {
        return $this->datePublishing;
    }

    public function setDatePublishing(?\DateTimeInterface $datePublishing): self
    {
        $this->datePublishing = $datePublishing;

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

    public function getLat(): ?float
    {
        return $this->lat;
    }

    public function setLat(?float $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLng(): ?float
    {
        return $this->lng;
    }

    public function setLng(?float $lng): self
    {
        $this->lng = $lng;

        return $this;
    }

    public function getTimeMonday(): ?string
    {
        return $this->timeMonday;
    }

    public function setTimeMonday(?string $timeMonday): self
    {
        $this->timeMonday = $timeMonday;

        return $this;
    }

    public function getTimeTuesday(): ?string
    {
        return $this->timeTuesday;
    }

    public function setTimeTuesday(?string $timeTuesday): self
    {
        $this->timeTuesday = $timeTuesday;

        return $this;
    }

    public function getTimeWenesday(): ?string
    {
        return $this->timeWenesday;
    }

    public function setTimeWenesday(?string $timeWenesday): self
    {
        $this->timeWenesday = $timeWenesday;

        return $this;
    }

    public function getTimeThursday(): ?string
    {
        return $this->timeThursday;
    }

    public function setTimeThursday(?string $timeThursday): self
    {
        $this->timeThursday = $timeThursday;

        return $this;
    }

    public function getTimeFriday(): ?string
    {
        return $this->timeFriday;
    }

    public function setTimeFriday(?string $timeFriday): self
    {
        $this->timeFriday = $timeFriday;

        return $this;
    }

    public function getTimeSaturday(): ?string
    {
        return $this->timeSaturday;
    }

    public function setTimeSaturday(?string $timeSaturday): self
    {
        $this->timeSaturday = $timeSaturday;

        return $this;
    }

    public function getTimeSunday(): ?string
    {
        return $this->timeSunday;
    }

    public function setTimeSunday(?string $timeSunday): self
    {
        $this->timeSunday = $timeSunday;

        return $this;
    }
}
