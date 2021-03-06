<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ShopProfile
 *
 * @ORM\Table(name="shop_profile", indexes={@ORM\Index(name="user_fk", columns={"user_id"}), @ORM\Index(name="IDX_8264EA252D5B0234", columns={"city"}), @ORM\Index(name="IDX_8264EA254CE6C7A4", columns={"town"})})
 * @ORM\Entity(repositoryClass="App\Repository\ShopProfileRepository")
 */
class ShopProfile
{
    public function __toString()
    {
        return $this->name;
    }

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=120, nullable=false)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $description = null;

    /**
     * @var string|null
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $address = null;

    /**
     * @var string|null
     *
     * @ORM\Column(name="phone", type="string", length=30, nullable=true, options={"default"="NULL"})
     */
    private $phone = null;

    /**
     * @var City|null
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\City")
     * @ORM\JoinColumn(name="city",referencedColumnName="id")
     */
    private $city = null;

    /**
     * @var Town|null
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Town")
     * @ORM\JoinColumn(name="town",referencedColumnName="id")
     */
    private $town = null;

    /**
     * @var float|null
     *
     * @ORM\Column(name="Latitude", type="float", precision=10, scale=0, nullable=true)
     */
    private $latitude = null;

    /**
     * @var float|null
     *
     * @ORM\Column(name="Longitude", type="float", precision=10, scale=0, nullable=true)
     */
    private $longitude = null;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @var Products
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Products",mappedBy="shop")
     */
    private $products;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CampaignCondition",mappedBy="shop")
     */
    private $campaignCondition;

    /**
     * @var int|null
     *
     * @ORM\Column(name="rating", type="integer", nullable=true,options={"default":0})
     */
    private $rating = 0;

    public function __construct()
    {
        $this->campaignCondition = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Products[]|null
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param Products $products
     */
    public function setProducts(Products $products): void
    {
        $this->products = $products;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return null|string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param null|string $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return null|string
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param null|string $address
     */
    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    /**
     * @return null|string
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param null|string $phone
     */
    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return City|null
     */
    public function getCity(): ?City
    {
        return $this->city;
    }

    /**
     * @param City|null $city
     */
    public function setCity(?City $city): void
    {
        $this->city = $city;
    }

    /**
     * @return Town|null
     */
    public function getTown(): ?Town
    {
        return $this->town;
    }

    /**
     * @param Town|null $town
     */
    public function setTown(?Town $town): void
    {
        $this->town = $town;
    }

    /**
     * @return float|null
     */
    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    /**
     * @param float|null $latitude
     */
    public function setLatitude(?float $latitude): void
    {
        $this->latitude = $latitude;
    }

    /**
     * @return float|null
     */
    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    /**
     * @param float|null $longitude
     */
    public function setLongitude(?float $longitude): void
    {
        $this->longitude = $longitude;
    }

    /**
     * @return int|null
     */
    public function getRating(): ?int
    {
        return $this->rating;
    }

    /**
     * @param int|null $rating
     */
    public function setRating(?int $rating): void
    {
        $this->rating = $rating;
    }

}
