<?php
namespace Sylapi\Feeds\Skapiec\Models;

use Sylapi\Feeds\Skapiec\Feed;
use JMS\Serializer\Annotation as Serializer;
use Sylapi\Feeds\Skapiec\Enums\Availability;
use Sylapi\Feeds\Contracts\ProductSerializer;
use Sylapi\Feeds\Skapiec\Models\ProductDetail;

/**
 * @Serializer\XmlRoot("item")
 * @Serializer\AccessType("public_method")
 */

class Product implements ProductSerializer
{
    /**
     * @Serializer\Type("string")
     * @Serializer\SerializedName("compid")
     * @Serializer\XmlElement(cdata=false)
     */
    private $id;

    /**
     * @Serializer\Type("string")
     * @Serializer\SerializedName("name")
     */
    private $title;

    /**
     * @Serializer\Type("string")
     * @Serializer\SerializedName("desclong")
     */
    private $description;

    /**
     * @Serializer\Type("string")
     * @Serializer\SerializedName("url")
     * @Serializer\XmlElement(cdata=false)
     */
    private $link;

    /**
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\XmlList(inline = true, entry = "photo")
     */
    private $additionalImageLinks;

    /**
     * @Serializer\Type("double")
     * @Serializer\Exclude(if="object.getSalePrice() !== null")
     */
    private $price;


    /**
     * @Serializer\Type("double")
     * @Serializer\SerializedName("price")
     */
    private $salePrice;


    /**
     * @Serializer\Type("string")
     * @Serializer\Exclude
     */
    private $productCategory;

    /**
     * @Serializer\Type("string")
     * @Serializer\SerializedName("vendor")
     */
    private $manufacturer;    

    /**
     * @Serializer\Type("string")
     * @Serializer\SerializedName("ean")
     */
    private $gtin;  

    /**
     * @Serializer\Type("string")
     * @Serializer\SerializedName("partnr")
     */
    private $mpn;
    
    /**
     * @Serializer\Type("Sylapi\Feeds\Skapiec\Models\Shipping")
     * @Serializer\Exclude
     */
    private $shipping;

    /**
     * @Serializer\Type("array<Sylapi\Feeds\Skapiec\Models\ProductDetail>")
     * @Serializer\XmlList(inline = true, entry = "property")    
     */
    private $productDetails;
    
    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of link
     */ 
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set the value of link
     *
     * @return  self
     */ 
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }    

    /**
     * Get the value of additionalImageLinks
     */ 
    public function getAdditionalImageLinks()
    {
        return $this->additionalImageLinks;
    }

    /**
     * Set the value of additionalImageLinks
     *
     * @return  self
     */ 
    public function setAdditionalImageLinks($additionalImageLinks)
    {
        $this->additionalImageLinks = $additionalImageLinks;

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of salePrice
     */ 
    public function getSalePrice()
    {
        return $this->salePrice;
    }

    /**
     * Set the value of salePrice
     *
     * @return  self
     */ 
    public function setSalePrice($salePrice)
    {
        $this->salePrice = $salePrice;

        return $this;
    }

    /**
     * Get the value of productCategory
     */ 
    public function getProductCategory()
    {
        return $this->productCategory;
    }

    /**
     * Set the value of productCategory
     *
     * @return  self
     */ 
    public function setProductCategory($productCategory)
    {
        $this->productCategory = $productCategory;

        return $this;
    }

    /**
     * @Serializer\VirtualProperty
     * @Serializer\SerializedName("catpath")
     * @return string|null
     */
    public function getCatPath()
    {
        if($this->getProductCategory() === null || strlen($this->getProductCategory()) === 0) {
            return null;
        }
        
        $categories = explode('/', $this->getProductCategory());

        if(($categories == false) || (is_array($categories) && count($categories) === 1 )) {
            return null;
        }
        $categories = array_map('trim', $categories);
        array_pop($categories);
        return implode(' / ', $categories);
    }


    /**
     * @Serializer\VirtualProperty
     * @Serializer\SerializedName("catname")
     * @return string|null
     */
    public function getCatName()
    {
        if($this->getProductCategory() === null || strlen($this->getProductCategory()) === 0) {
            return null;
        }
        
        $categories = explode('/', $this->getProductCategory());
        if($categories == false) {
            return $this->getProductCategory();
        }
        return trim(end($categories));
    }
    
    /**
     * Get the value of manufacturer
     */ 
    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    /**
     * Set the value of manufacturer
     *
     * @return  self
     */ 
    public function setManufacturer($manufacturer)
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    /**
     * Get the value of gtin
     */ 
    public function getGtin()
    {
        return $this->gtin;
    }

    /**
     * Set the value of gtin
     *
     * @return  self
     */ 
    public function setGtin($gtin)
    {
        $this->gtin = $gtin;

        return $this;
    }

    /**
     * Get the value of mpn
     */ 
    public function getMpn()
    {
        return $this->mpn;
    }

    /**
     * Set the value of mpn
     *
     * @return  self
     */ 
    public function setMpn($mpn)
    {
        $this->mpn = $mpn;

        return $this;
    }

    /**
     * Get the value of shipping
     */ 
    public function getShipping()
    {
        return $this->shipping;
    }


    /**
     * Set the value of shipping
     *
     * @return  self
     */ 
    public function setShipping($shipping)
    {
        $this->shipping = $shipping;

        return $this;
    }
    
    /**
     * @Serializer\VirtualProperty
     * @Serializer\Type("integer")
     * @Serializer\SerializedName("availability")
     * @return int|null
     */
    public function getAvailabilityProperty()
    {
        $shipping = $this->getShipping();
        if (!($shipping instanceof Shipping && $shipping->getMaxHandlingTime())) {
            return null;
        }

        $maxHandlingTime = $shipping->getMaxHandlingTime();

        $response = null;

        switch ($maxHandlingTime) {
            case 0: 
                $response = Availability::IMMEDIATELY;
            break;
            case 1: 
                $response = Availability::UP_1_DAY;
            break;
            case 2: 
                $response = Availability::UP_2_DAYS;
            break;
            case 3: 
                $response = Availability::UP_3_DAYS;
            break;
            case ($maxHandlingTime > 3 && $maxHandlingTime <= 7): 
                $response = Availability::UP_7_DAYS;
            break;
            case ($maxHandlingTime > 7): 
                $response = Availability::FROM_7_DAYS;
            break;                                       
        }

        return $response;
    }


    /**
     * @Serializer\VirtualProperty
     * @Serializer\Type("integer")
     * @Serializer\SerializedName("pdelievery")
     * @return string|null
     */
    public function getShippingPriceProperty()
    {
        $shipping = $this->getShipping();
        if (!($shipping instanceof Shipping && $shipping->getPrice())) {
            return null;
        }

        return $shipping->getPrice();
    }

    /**
     * Get the value of productDetails
     */ 
    public function getProductDetails()
    {
        return $this->productDetails;
    }

    /**
     * Set the value of productDetails
     *
     * @return  self
     */ 
    public function setProductDetails($productDetails)
    {
        $this->productDetails = $productDetails;

        return $this;
    }

    public function make(\Sylapi\Feeds\Models\Product $product): self
    {
        $item  = new self;

        $itemVars = array_keys(get_class_vars(self::class));
    
        foreach($itemVars as $itemVar) {
            $getterName = 'get'.ucfirst($itemVar);
            $setterName = 'set'.ucfirst($itemVar);

            if(method_exists($product, $getterName) && method_exists($item, $setterName)) {
                $elem =  $product->{$getterName}();
                if(is_object($elem)) {
                    switch(get_class($elem)) {
                        case 'Sylapi\Feeds\Models\Shipping' :
                            $elem = (new Shipping)->make($elem);
                        break;                        
                    }
                }

                if($itemVar === 'productCategory') {
                    if(is_array($elem) && isset($elem[Feed::NAME])) {
                        $elem = $elem[Feed::NAME];
                    } else {
                        $elem = null;
                    }
                }

                if($itemVar === 'productDetails') {
                    if(isset($elem[Feed::NAME]) && is_array($elem[Feed::NAME])) {
                        $elems = [];
                        foreach($elem[Feed::NAME] as $pd){
                            $elems[] = (new ProductDetail)->make($pd);
                        }
                        $elem = $elems;
                    } else {
                        $elem = null;
                    }
                }

                $item->{$setterName}($elem);  
            }
        }

        return $item;
    }
}
