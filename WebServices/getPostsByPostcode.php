<?php
header('Content-type: text/xml');
if (isset($_REQUEST['postcode'])) { //accept POST and GET REST
    $postcode = trim($_REQUEST['postcode']);
    if (preg_match("/[^a-zA-Z0-9 \-']|^$/", $postcode)){
        die('<Sitters/>');
    }
    $postcode = str_replace(' ', '+', $postcode);
} else {
    die('<Sitters/>');
}

include '../XmlDom.php';
include '../XmlPublisher.php';

$lewishamServiceUrl = 'http://stuiis.cms.gre.ac.uk/am238/soa/lewisham/LewishamService.asmx/getLewishamPostsByPostcode?postcode='.$postcode;
$greenwichServiceUrl = 'http://stuweb.cms.gre.ac.uk/~am238/soa/greenwich/WebServices/getGreenwichPostsByPostcode.php?postcode='.$postcode;

publishXml(XmlDom::mergeXmlDoms(XmlDom::getXmlDom($lewishamServiceUrl), XmlDom::getXmlDom($greenwichServiceUrl)));

?>
