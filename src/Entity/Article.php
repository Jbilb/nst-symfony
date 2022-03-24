<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
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
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cover_image;

    /**
     * @ORM\Column(type="date")
     */
    private $date_publication;

    /**
     * @ORM\Column(type="text")
     */
    private $intro_text;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $body_texts = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $body_titles = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $body_images = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $body_galeries = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $body_cta = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $body_links = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $body_videos = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $body_pdf = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $body_html_element = [];

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $lectures;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $is_active;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $featured;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    // @ORM\JoinColumn(nullable=false)
    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class)
    * 
     */
    private $categorie;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
    }

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

    public function getCoverImage(): ?string
    {
        return $this->cover_image;
    }

    public function setCoverImage(string $cover_image): self
    {
        $this->cover_image = $cover_image;

        return $this;
    }

    public function getDatePublication(): ?\DateTimeInterface
    {
        return $this->date_publication;
    }

    public function setDatePublication(\DateTimeInterface $date_publication): self
    {
        $this->date_publication = $date_publication;

        return $this;
    }

    public function getIntroText(): ?string
    {
        return $this->intro_text;
    }

    public function setIntroText(string $intro_text): self
    {
        $this->intro_text = $intro_text;

        return $this;
    }

    public function getBodyTexts(): ?array
    {
        return $this->body_texts;
    }

    public function setBodyTexts(?array $body_texts): self
    {
        $this->body_texts = $body_texts;

        return $this;
    }

    public function getBodyTitles(): ?array
    {
        return $this->body_titles;
    }

    public function setBodyTitles(?array $body_titles): self
    {
        $this->body_titles = $body_titles;

        return $this;
    }

    public function getBodyImages(): ?array
    {
        return $this->body_images;
    }

    public function setBodyImages(?array $body_images): self
    {
        $this->body_images = $body_images;

        return $this;
    }

    public function getBodyGaleries(): ?array
    {
        return $this->body_galeries;
    }

    public function setBodyGaleries(?array $body_galeries): self
    {
        $this->body_galeries = $body_galeries;

        return $this;
    }

    public function getBodyCta(): ?array
    {
        return $this->body_cta;
    }

    public function setBodyCta(?array $body_cta): self
    {
        $this->body_cta = $body_cta;

        return $this;
    }

    public function getBodyLinks(): ?array
    {
        return $this->body_links;
    }

    public function setBodyLinks(?array $body_links): self
    {
        $this->body_links = $body_links;

        return $this;
    }

    public function getBodyVideos(): ?array
    {
        return $this->body_videos;
    }

    public function setBodyVideos(?array $body_videos): self
    {
        $this->body_videos = $body_videos;

        return $this;
    }

    public function getBodyPdf(): ?array
    {
        return $this->body_pdf;
    }

    public function setBodyPdf(?array $body_pdf): self
    {
        $this->body_pdf = $body_pdf;

        return $this;
    }

    public function getBodyHtmlElement(): ?array
    {
        return $this->body_html_element;
    }

    public function setBodyHtmlElement(?array $body_html_element): self
    {
        $this->body_html_element = $body_html_element;

        return $this;
    }

    public function getLectures(): ?int
    {
        return $this->lectures;
    }

    public function setLectures(?int $lectures): self
    {
        $this->lectures = $lectures;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->is_active;
    }

    public function setIsActive(?bool $is_active): self
    {
        $this->is_active = $is_active;

        return $this;
    }

    public function getFeatured(): ?bool
    {
        return $this->featured;
    }

    public function setFeatured(?bool $featured): self
    {
        $this->featured = $featured;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function createBody()
    {
        $page_body = [];
        
        if(!empty($this->body_titles))
        {
            foreach($this->body_titles as $key => $value)
            {
                $page_body[$key]['body_titles'] = $value;
            }
        }
        
        if(!empty($this->body_texts))
        {
            foreach($this->body_texts as $key => $value)
            {
                $page_body[$key]['body_texts'] = $value;
            }
        }
        
        if(!empty($this->body_images))
        {
            foreach($this->body_images as $key => $value)
            {
                $page_body[$key]['body_images'] = $value;
            }
        }
        
        if(!empty($this->body_links))
        {
            foreach($this->body_links as $key => $value)
            {
                $page_body[$key]['body_links'] = $value;
            }
        }
        
        if(!empty($this->body_cta))
        {
            foreach($this->body_cta as $key => $value)
            {
                $page_body[$key]['body_cta'] = $value;
            }
        }
        
        if(!empty($this->body_galeries))
        {
            foreach($this->body_galeries as $key => $value)
            {
                $page_body[$key]['body_galeries'] = $value;
            }
        }
        
        if(!empty($this->body_videos))
        {
            foreach($this->body_videos as $key => $value)
            {
                $page_body[$key]['body_videos'] = $value;
            }
        }
        
        if(!empty($this->body_pdf))
        {
            foreach($this->body_pdf as $key => $value)
            {
                $page_body[$key]['body_pdf'] = $value;
            }
        }
        
        if(!empty($this->body_html_element))
        {
            foreach($this->body_html_element as $key => $value)
            {
                $page_body[$key]['body_html_element'] = $value;
            }
        }
        
        return $page_body;
    }
}