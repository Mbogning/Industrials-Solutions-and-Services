<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProjetRepository;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=ProjetRepository::class)
 * @Vich\Uploadable
 */
class Projet
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
    private $titre;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lieu;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $siteWeb;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @Assert\File(
     *     maxSizeMessage = "L'image ne doit pas dépasser 10Mb.",
     *     maxSize = "10024k",
     *     mimeTypes = {"image/jpg", "image/jpeg", "image/gif", "image/png"},
     *     mimeTypesMessage = "Les images doivent être au format JPG, GIF ou PNG."
     * )
     * @Vich\UploadableField(mapping="projet_image", fileNameProperty="image")
     * @var File|null
     */
    private $imageFile;

     /**
     * @ORM\Column(type="date")
     */
    private $debutProjet;

    /**
     * @ORM\Column(type="date")
     */
    private $finProjet;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getDebutProjet(): ?\DateTimeInterface
    {
        return $this->debutProjet;
    }

    public function setDebutProjet(\DateTimeInterface $debutProjet): self
    {
        $this->debutProjet = $debutProjet;

        return $this;
    }

    public function getFinProjet(): ?\DateTimeInterface
    {
        return $this->finProjet;
    }

    public function setFinProjet(\DateTimeInterface $finProjet): self
    {
        $this->finProjet = $finProjet;

        return $this;
    }


    public function getSiteWeb(): ?string
    {
        return $this->siteWeb;
    }

    public function setSiteWeb(?string $siteWeb): self
    {
        $this->siteWeb = $siteWeb;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get )
     *
     * @return  File|null
     */ 
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * Set )
     *
     * @param  File|null  $imageFile  )
     *
     * @return  self
     */ 
    public function setImageFile(File $imageFile)
    {
        $this->imageFile = $imageFile;

        return $this;
    }
}
