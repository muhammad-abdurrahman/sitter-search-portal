<?php
header('Content-type: text/xml');
if (isset($_REQUEST['id'])) { //accept POST and GET REST
    $sitterId = trim($_REQUEST['id']);
    if (preg_match("/[^0-9]+$/", $sitterId))
        die('<Sitters/>');
} else {
    die('<Sitters/>');
}

include '../XmlDom.php';
include '../XmlPublisher.php';

$lewishamServiceUrl = 'http://stuiis.cms.gre.ac.uk/am238/soa/lewisham/LewishamService.asmx/getLewishamSittersById?id=' . $sitterId;
$greenwichServiceUrl = 'http://stuweb.cms.gre.ac.uk/~am238/soa/greenwich/WebServices/getGreenwichSittersById.php?id=' . $sitterId;

publishXml(XmlDom::mergeXmlDoms(XmlDom::getXmlDom($lewishamServiceUrl), XmlDom::getXmlDom($greenwichServiceUrl)));

?>
