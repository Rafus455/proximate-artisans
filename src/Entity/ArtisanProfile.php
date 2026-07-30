<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class ArtisanProfile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToOne(targetEntity: User::class, inversedBy: 'artisanProfile', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    #[ORM\Column(type: 'string', length: 255)]
    private $companyName;

    #[ORM\Column(type: 'string', length: 255)]
    private $trade;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\Column(type: 'string', length: 255)]
    private $city;

    #[ORM\Column(type: 'string', length: 10)]
    private $postalCode;

    #[ORM\Column(type: 'float', nullable: true)]
    private $latitude;

    #[ORM\Column(type: 'float', nullable: true)]
    private $longitude;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $indicativeRate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function setCompanyName(string $companyName): self
    {
        $this->companyName = $companyName;

        return $this;
    }

    public function getTrade(): ?string
    {
        return $this->trade;
    }

    public function setTrade(string $trade): self
    {
        $this->trade = $trade;

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

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(?float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(?float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getIndicativeRate(): ?string
    {
        return $this->indicativeRate;
    }

    public function setIndicativeRate(?string $indicativeRate): self
    {
        $this->indicativeRate = $indicativeRate;

        return $this;
    }
}
