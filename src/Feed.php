<?php
namespace Sylapi\Feeds\Skapiec;

use Sylapi\Feeds\Abstracts\Feed as FeedAbstract;
use Sylapi\Feeds\Contracts\ProductSerializer;

class Feed extends FeedAbstract
{
    const NAME = 'skapiec';

    public function getDefaultFileName(): string
    {
        return self::NAME;
    }

    public function getProductInstance(): ProductSerializer
    {
        return new Models\Product();
    }

    public function initXML(): \DOMElement
    {
        $doc = $this->getDocument();

        $nodeXMLData = $doc->createElement('xmldata');
        $doc->appendChild($nodeXMLData);

        $nodeTime = $doc->createElement('time', date('Y-m-d-H-i'));
        $nodeXMLData->appendChild($nodeTime);

        $nodeData = $doc->createElement('data');
        $nodeXMLData->appendChild($nodeData);

        $this->setMainXmlElement($nodeData);

        return $nodeXMLData;
    }

}