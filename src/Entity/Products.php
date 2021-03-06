<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * Products
 * - gedmo document https://github.com/Atlantic18/DoctrineExtensions/blob/v2.4.x/doc/sluggable.md#including-extension
 *
 * @ORM\Table(name="products", indexes={@ORM\Index(name="brand_property", columns={"brand_id"}), @ORM\Index(name="shop_property", columns={"shop_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\ProductsRepository")
 */
//Table index => , @ORM\Index(name="category_property", columns={"category_id"})
class Products
{
    public function __toString()
    {
        return (string)$this->name;
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
     * @var string|null
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(name="slug", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $slug = null;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $name = null;

    /**
     * @var string|null
     *
     * @ORM\Column(name="code", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $code = null;

    /**
     * @var int|null
     *
     * @ORM\Column(name="stock", type="smallint", nullable=true)
     */
    private $stock = 10;

    /**
     * @var string|null
     *
     * @ORM\Column(name="sub_description", type="text", nullable=true, options={"default"="NULL"})
     */
    private $subDescription = null;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="text", nullable=true, options={"default"="NULL"})
     */
    private $description = null;


    /**
     * @var string|null
     *
     * @ORM\Column(name="is_sponsored", type="smallint",nullable=true, options={"default"=0})
     */
    private $isSponsored = 0;

    /**
     * @var string|null
     *
     * @ORM\Column(name="metatags", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $metatags = null;

    /**
     * @var string|null
     *
     * @ORM\Column(name="metakeys", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $metakeys = null;

    /**
     * @var int|null
     *
     * @ORM\Column(name="status", type="smallint", nullable=true, options={"default"="1"})
     */
    private $status = 1;

    /**
     * @var bool
     *
     * @ORM\Column(name="isActive", type="boolean", nullable=false, options={"default"=1})
     */
    private $isActive = 1;

    /**
     * @var bool
     *
     * @ORM\Column(name="isDelete", type="boolean", nullable=false, options={"default"=0})
     */
    private $isDelete = 0;

    /**
     * @var float|null
     *
     * @ORM\Column(name="sell_price", type="float", nullable=true)
     */
    private $sellPrice = 0.0;

    /**
     * @var string|null
     *
     * @ORM\Column(name="currency", type="string",length=5, nullable=true)
     */
    private $currency = "TL";

    /**
     * @var \DateTime|null
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime", length=255, nullable=true)
     */
    private $createdAt = null;

    /**
     * @var \DateTime|null
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated_at", type="datetime", length=255, nullable=true)
     */
    private $updatedAt = null;

    /**
     * @var ProductsBrands
     *
     * @ORM\ManyToOne(targetEntity="ProductsBrands")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="brand_id", referencedColumnName="id")
     * })
     */
    private $brand;

    /**
     * @var Categories
     *
     * @ORM\ManyToOne(targetEntity="Categories",inversedBy="products")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * })
     */
    private $category;

    /**
     * @var ShopProfile
     *
     * @ORM\ManyToOne(targetEntity="ShopProfile",inversedBy="products")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="shop_id", referencedColumnName="id")
     * })
     */
    private $shop;

    /**
     * @var ProductsImages[]|ArrayCollection
     * @ORM\OneToMany(targetEntity="App\Entity\ProductsImages", mappedBy="product", cascade={"persist", "remove"}, orphanRemoval=true, fetch="LAZY")
     */
    public $productImages;

    /**
     * @var ProductComments|null
     *
     * @ORM\OneToMany(targetEntity="App\Entity\ProductComments",mappedBy="product", cascade={"persist", "remove"})
     */
    private $comments;

    public function __construct()
    {
        $this->productImages = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }


    /**
     * @return ProductComments|null
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param ProductComments $comments
     */
    public function setComments(ProductComments $comments): void
    {
        $this->comments = $comments;
    }

    /**
     * @return ProductsImages[]|ArrayCollection
     */
    public function getProductImages()
    {
        return $this->productImages;
    }

    /**
     * @param ProductsImages[]|ArrayCollection $productImages
     */
    public function setProductImages($productImages)
    {
        foreach ($productImages as $productImage) {
            $productImage->setProduct($this);

            $this->productImages->add($productImage);
        }
    }

    /**
     * Remove image
     *
     * @param ProductsImages $image
     */
    public function removeProductImages(ProductsImages $image)
    {
        $image->setProduct(null);
        $this->productImages->removeElement($image);
    }


    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * @param null|string $slug
     */
    public function setSlug(?string $slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param null|string $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;

        $slugify = new Slugify();
        $this->setSlug($slugify->slugify($name));
    }

    /**
     * @return null|string
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param null|string $code
     */
    public function setCode(?string $code): void
    {
        $this->code = $code;
    }

    /**
     * @return int|null
     */
    public function getStock(): ?int
    {
        return $this->stock;
    }

    /**
     * @param int|null $stock
     */
    public function setStock(?int $stock): void
    {
        $this->stock = $stock;
    }

    /**
     * @return null|string
     */
    public function getSubDescription(): ?string
    {
        return $this->subDescription;
    }

    /**
     * @param null|string $subDescription
     */
    public function setSubDescription(?string $subDescription): void
    {
        $this->subDescription = $subDescription;
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
    public function getMetatags(): ?string
    {
        return $this->metatags;
    }

    /**
     * @param null|string $metatags
     */
    public function setMetatags(?string $metatags): void
    {
        $this->metatags = $metatags;
    }

    /**
     * @return null|string
     */
    public function getMetakeys(): ?string
    {
        return $this->metakeys;
    }

    /**
     * @param null|string $metakeys
     */
    public function setMetakeys(?string $metakeys): void
    {
        $this->metakeys = $metakeys;
    }

    /**
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @param int|null $status
     */
    public function setStatus(?int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @param bool $isactive
     */
    public function setIsActive(bool $isactive): void
    {
        $this->isActive = $isactive;
    }

    /**
     * @return bool
     */
    public function isDelete(): bool
    {
        return $this->isDelete;
    }

    /**
     * @param bool $isdelete
     */
    public function setIsDelete(bool $isdelete): void
    {
        $this->isDelete = $isdelete;
    }

    /**
     * @return ProductsBrands|null
     */
    public function getBrand(): ?ProductsBrands
    {
        return $this->brand;
    }

    /**
     * @param ProductsBrands $brand
     */
    public function setBrand(ProductsBrands $brand): void
    {
        $this->brand = $brand;
    }

    /**
     * @return Categories|null
     */
    public function getCategory(): ?Categories
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
     * @return ShopProfile|null
     */
    public function getShop(): ?ShopProfile
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
     * @return float|null
     */
    public function getSellPrice(): ?float
    {
        return $this->sellPrice;
    }

    /**
     * @param float|null $sellPrice
     */
    public function setSellPrice(?float $sellPrice): void
    {
        $this->sellPrice = $sellPrice;
    }

    /**
     * @return null|string
     */
    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    /**
     * @param null|string $currency
     */
    public function setCurrency(?string $currency): void
    {
        $this->currency = $currency;
    }

    /**
     * @return null|string
     */
    public function getisSponsored(): ?string
    {
        return $this->isSponsored;
    }

    /**
     * @param null|string $isSponsored
     */
    public function setIsSponsored(?string $isSponsored): void
    {
        $this->isSponsored = $isSponsored;
    }


}
