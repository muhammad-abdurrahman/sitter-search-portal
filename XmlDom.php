<?php

class XmlDom {

    public static function getXmlDom($url) {
        try {
            $xmlString = file_get_contents($url);
            $xmlDom = new DOMDocument();
            $xmlDom->loadXML($xmlString, LIBXML_NOBLANKS);
        } catch (exception $e) {
            echo '<p>Unable to contact Web Service</p>';
            echo '<p>Caught exception: ' . $e->getMessage() . "</p>\n";
        }
        return $xmlDom;
    }

    public static function mergeXmlDoms($xmlDom1, $xmlDom2) {
        $xmlRoot1 = $xmlDom1->documentElement;
        foreach ($xmlDom2->documentElement->childNodes as $node2) {
            $node1 = $xmlDom1->importNode($node2, true);
            $xmlRoot1->appendChild($node1);
        }
        return $xmlDom1;
    }

}

?>