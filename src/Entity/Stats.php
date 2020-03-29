<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StatsRepository")
 */
class Stats
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $visitor;

    /**
     * @ORM\Column(type="integer")
     */
    private $uniqueVisitor;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVisitor(): ?int
    {
        return $this->visitor;
    }

    public function setVisitor(int $visitor): self
    {
        $this->visitor = $visitor;

        return $this;
    }

    public function getUniqueVisitor(): ?int
    {
        return $this->uniqueVisitor;
    }

    public function setUniqueVisitor(int $uniqueVisitor): self
    {
        $this->uniqueVisitor = $uniqueVisitor;

        return $this;
    }
}
