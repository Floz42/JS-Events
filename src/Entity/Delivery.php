<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DeliveryRepository")
 * @ORM\HasLifecycleCallbacks()
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
     * @Assert\NotBlank(message="Ce champ ne peut pas être vide")
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

    public function setPicture(string $picture): self
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
     * if date is empty, create automatically oone at "now"
     * 
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function prePersit()
    {
        if (empty($this->createdAt)) {
            $this->createdAt = new \DateTime();
        }
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
}
