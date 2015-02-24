<?php

include 'XmlDom.php';
include 'XmlPublisher.php';

$url = 'http://stuweb.cms.gre.ac.uk/~am238/soa/greenwich/resources/sml.xsd';
publishXml(XmlDom::getXmlDom($url));
?>