<?php

header('Content-type: text/xml');
if (isset($_REQUEST['sitterType']) && isset($_REQUEST['postcode'])) { //accept POST and GET REST
    $sitterType = trim($_REQUEST['sitterType']);
    $postcode = trim($_REQUEST['postcode']);
    if (preg_match("/[^a-zA-Z\-']|^$/", $sitterType) || preg_match("/[^a-zA-Z0-9 \-']|^$/", $postcode)) {
        die('<Sitters/>');
    }
    $postcode = str_replace(' ', '+', $postcode);
} else {
    die('<Sitters/>');
}

include '../XmlDom.php';
include '../XmlPublisher.php';

$lewishamServiceUrl = 'http://stuiis.cms.gre.ac.uk/am238/soa/lewisham/LewishamService.asmx/getAllLewishamPostsGivenSitterTypeAndPostcodeWithoutImages'
        . '?sitterType=' . $sitterType . '&postcode=' . $postcode;
$greenwichServiceUrl = 'http://stuweb.cms.gre.ac.uk/~am238/soa/greenwich/WebServices/getAllGreenwichPostsGivenSitterTypeAndPostcodeWithoutImages.php'
        . '?sitterType=' . $sitterType . '&postcode=' . $postcode;

publishXml(XmlDom::mergeXmlDoms(XmlDom::getXmlDom($lewishamServiceUrl), XmlDom::getXmlDom($greenwichServiceUrl)));
?>
