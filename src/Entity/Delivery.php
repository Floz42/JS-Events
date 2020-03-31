<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DeliveryRepository")
 * @Vich\Uploadable
 */
class Delivery
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $picture;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ce champ ne peut pas être vide")
     */
    private $title;

    /**
     * @ORM\Column(type="array")
     */
    private $options = [];

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Ce champ ne peut pas être vide")
     */
    private $price;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="deliveries_image", fileNameProperty="picture")
     * 
     * @var File|null
     */
    private $imageFile;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OptionDelivery", mappedBy="delivery", orphanRemoval=true)
     */
    private $optionDeliveries;

    public function __construct()
    {
        $this->optionDeliveries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
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

    public function getOptions(): ?array
    {
        return $this->options;
    }

    public function setOptions(array $options): self
    {
        $this->options = $options;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|OptionDelivery[]
     */
    public function getOptionDeliveries(): Collection
    {
        return $this->optionDeliveries;
    }

    public function addOptionDelivery(OptionDelivery $optionDelivery): self
    {
        if (!$this->optionDeliveries->contains($optionDelivery)) {
            $this->optionDeliveries[] = $optionDelivery;
            $optionDelivery->setDelivery($this);
        }

        return $this;
    }

    public function removeOptionDelivery(OptionDelivery $optionDelivery): self
    {
        if ($this->optionDeliveries->contains($optionDelivery)) {
            $this->optionDeliveries->removeElement($optionDelivery);
            // set the owning side to null (unless already changed)
            if ($optionDelivery->getDelivery() === $this) {
                $optionDelivery->setDelivery(null);
            }
        }

        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }
    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): self
    {
        $this->imageFile = $imageFile;

         if ($this->imageFile instanceof UploadedFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->createdAt = new \DateTime('now');
        }
        return $this;
    }
}
