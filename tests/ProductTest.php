<?php

namespace Sylapi\Feeds\Skapiec\Tests;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Sylapi\Feeds\FeedGenerator;
use Sylapi\Feeds\Skapiec\Feed;
use Sylapi\Feeds\Skapiec\Models\Product;
use Sylapi\Feeds\Skapiec\Models\Shipping;
use Sylapi\Feeds\Skapiec\Models\ProductDetail;

class ProductTest extends PHPUnitTestCase
{

    private $product;

    private $serializer;

    public function setUp():void
    {
        $this->product = $this->createProduct();
        $this->serializer = (new FeedGenerator())->getSerializer();
    }

    private function createProduct(): Product
    {

        $productDetails = [];
        for($x = 0; $x < 4; $x++)  {
            $productDetail = new ProductDetail();
            $productDetail->setAttributeName('param_'.$x)
                ->setAttributeValue('Value '.$x);
    
            $productDetails[] = $productDetail;
        }
        
        $shipping = new Shipping();
        $shipping->setPrice(12.22)
            ->setMaxHandlingTime(12);
    

        $product = new Product();
        
        $product->setId('1234567890')
            ->setTitle('Test title')
            ->setDescription('Test Description')
            ->setLink('http://link.dev/product/1.html')
            ->setAdditionalImageLinks([
                'http://link.dev/storage/1/2.jpg',
                'http://link.dev/storage/1/3.jpg',
                'http://link.dev/storage/1/4.jpg'
            ])
            ->setPrice(100.00)
            ->setSalePrice(90.00)
            ->setProductCategory('Elektronika')
            ->setManufacturer('Test Manufacturer')
            ->setGtin('1234567890')
            ->setMpn('0987654321')
            ->setShipping($shipping)
            ->setProductDetails($productDetails)
            ;
        return $product;
    }


    public function testProductXML()
    {
        $content = $this->serializer->serialize($this->product, 'xml');
        $filePath = __DIR__.'/Mock/product.xml';

        $this->assertXmlStringEqualsXmlFile($filePath, $content);
    }

    public function testMakeProduct()
    {
        $categoryName = 'Test Category';

        $productBase = new \Sylapi\Feeds\Models\Product();
        $productBase->setProductCategory([
            Feed::NAME => $categoryName
            ])
            ->setShipping(new \Sylapi\Feeds\Models\Shipping())
            ->setProductDetails([
                Feed::NAME => [ new \Sylapi\Feeds\Models\ProductDetail() ]
            ])
        ;
        $product = (new Product)->make($productBase);
        $productDetails = $product->getProductDetails();
        $this->assertInstanceOf(Product::class, $product);
        $this->assertInstanceOf(Shipping::class, $product->getShipping());
        $this->assertInstanceOf(ProductDetail::class, $productDetails[0]);
        $this->assertEquals($categoryName, $product->getProductCategory());

    }
}