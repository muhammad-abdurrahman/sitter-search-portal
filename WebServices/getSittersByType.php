<?php
header('Content-type: text/xml');
if (isset($_REQUEST['type'])) { //accept POST and GET REST
    $type = trim($_REQUEST['type']);
    if (preg_match("/[^a-zA-Z\-']|^$/", $type))
        die('<Sitters/>');
} else {
    die('<Sitters/>');
}

include '../XmlDom.php';
include '../XmlPublisher.php';

$lewishamServiceUrl = 'http://stuiis.cms.gre.ac.uk/am238/soa/lewisham/LewishamService.asmx/getLewishamSittersByType?type=' . $type;
$greenwichServiceUrl = 'http://stuweb.cms.gre.ac.uk/~am238/soa/greenwich/WebServices/getGreenwichSittersByType.php?type=' . $type;

publishXml(XmlDom::mergeXmlDoms(XmlDom::getXmlDom($lewishamServiceUrl), XmlDom::getXmlDom($greenwichServiceUrl)));

?>