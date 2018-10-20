<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Campaigns
 *
 * @ORM\Table(name="campaigns", indexes={@ORM\Index(name="campaign_condition_property", columns={"condition_id"}), @ORM\Index(name="campaign_category_property", columns={"category_id"}), @ORM\Index(name="campaign_product_property", columns={"product_id"}), @ORM\Index(name="campaign_shop_property", columns={"shop_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\CampaignsRepository")
 */
class Campaigns
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="campaign_name", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $campaignName = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="campaign_description", type="text", length=65535, nullable=true, options={"default"="NULL"})
     */
    private $campaignDescription = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="campaign_start_date", type="date", nullable=true, options={"default"="NULL"})
     */
    private $campaignStartDate = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="campaign_end_date", type="date", nullable=true, options={"default"="NULL"})
     */
    private $campaignEndDate = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $createdAt = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $updatedAt = 'NULL';

    /**
     * @var Categories
     *
     * @ORM\ManyToOne(targetEntity="Categories")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * })
     */
    private $category;

    /**
     * @var CampaignCondition
     *
     * @ORM\ManyToOne(targetEntity="CampaignCondition")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="condition_id", referencedColumnName="id")
     * })
     */
    private $condition;

    /**
     * @var Products
     *
     * @ORM\ManyToOne(targetEntity="Products")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     * })
     */
    private $product;

    /**
     * @var ShopProfile
     *
     * @ORM\ManyToOne(targetEntity="ShopProfile")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="shop_id", referencedColumnName="id")
     * })
     */
    private $shop;



    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getCampaignName(): ?string
    {
        return $this->campaignName;
    }

    /**
     * @param null|string $campaignName
     */
    public function setCampaignName(?string $campaignName): void
    {
        $this->campaignName = $campaignName;
    }

    /**
     * @return null|string
     */
    public function getCampaignDescription(): ?string
    {
        return $this->campaignDescription;
    }

    /**
     * @param null|string $campaignDescription
     */
    public function setCampaignDescription(?string $campaignDescription): void
    {
        $this->campaignDescription = $campaignDescription;
    }

    /**
     * @return \DateTime|null
     */
    public function getCampaignStartDate(): ?\DateTime
    {
        return $this->campaignStartDate;
    }

    /**
     * @param \DateTime|null $campaignStartDate
     */
    public function setCampaignStartDate(?\DateTime $campaignStartDate): void
    {
        $this->campaignStartDate = $campaignStartDate;
    }

    /**
     * @return \DateTime|null
     */
    public function getCampaignEndDate(): ?\DateTime
    {
        return $this->campaignEndDate;
    }

    /**
     * @param \DateTime|null $campaignEndDate
     */
    public function setCampaignEndDate(?\DateTime $campaignEndDate): void
    {
        $this->campaignEndDate = $campaignEndDate;
    }

    /**
     * @return \DateTime|null
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime|null $createdAt
     */
    public function setCreatedAt(?\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime|null
     */
    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime|null $updatedAt
     */
    public function setUpdatedAt(?\DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return Categories
     */
    public function getCategory(): Categories
    {
        return $this->category;
    }

    /**
     * @param Categories $category
     */
    public function setCategory(Categories $category): void
    {
        $this->category = $category;
    }

    /**
     * @return CampaignCondition
     */
    public function getCondition(): CampaignCondition
    {
        return $this->condition;
    }

    /**
     * @param CampaignCondition $condition
     */
    public function setCondition(CampaignCondition $condition): void
    {
        $this->condition = $condition;
    }

    /**
     * @return Products
     */
    public function getProduct(): Products
    {
        return $this->product;
    }

    /**
     * @param Products $product
     */
    public function setProduct(Products $product): void
    {
        $this->product = $product;
    }

    /**
     * @return ShopProfile
     */
    public function getShop(): ShopProfile
    {
        return $this->shop;
    }

    /**
     * @param ShopProfile $shop
     */
    public function setShop(ShopProfile $shop): void
    {
        $this->shop = $shop;
    }


}
