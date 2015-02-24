<?php
header('Content-type: text/xml');
if (isset($_REQUEST['price'])) { //accept POST and GET REST
    $price = trim($_REQUEST['price']);
    if (preg_match("/[^0-9.\-']|^$/", $price))
        die('<Sitters/>');
} else {
    die('<Sitters/>');
}

include '../XmlDom.php';
include '../XmlPublisher.php';

$lewishamServiceUrl = 'http://stuiis.cms.gre.ac.uk/am238/soa/lewisham/LewishamService.asmx/getLewishamPostsByPrice?price='.$price;
$greenwichServiceUrl = 'http://stuweb.cms.gre.ac.uk/~am238/soa/greenwich/WebServices/getGreenwichPostsByPrice.php?price='.$price;

publishXml(XmlDom::mergeXmlDoms(XmlDom::getXmlDom($lewishamServiceUrl), XmlDom::getXmlDom($greenwichServiceUrl)));

?>
