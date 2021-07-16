<?php

namespace Sylapi\Feeds\Skapiec\Tests;


use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Sylapi\Feeds\Contracts\ProductSerializer;
use Sylapi\Feeds\Skapiec\Feed;
use Sylapi\Feeds\Skapiec\Models\Product;
use Sylapi\Feeds\Parameters;

class FeedTest extends PHPUnitTestCase
{
    private $feed;

    public function setUp():void
    {
        $this->feed =  new Feed(Parameters::create([]));
    }


    public function testDefaultFileName()
    {
        $this->assertEquals(Feed::NAME, $this->feed->getDefaultFileName());
    }

    public function testProductInstance()
    {
        $this->assertInstanceOf(Product::class, $this->feed->getProductInstance());
        $this->assertInstanceOf(ProductSerializer::class, $this->feed->getProductInstance());
    }

    public function testInitXML()
    {
        $this->assertInstanceOf(\DOMElement::class, $this->feed->initXML());
    }
}