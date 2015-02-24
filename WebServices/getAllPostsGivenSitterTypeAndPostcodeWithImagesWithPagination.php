<?php

header('Content-type: text/xml');
if (isset($_REQUEST['sitterType']) && isset($_REQUEST['postcode'])) { //accept POST and GET REST
    $sitterType = trim($_REQUEST['sitterType']);
    $postcode = trim($_REQUEST['postcode']);
    $fromRecordNo = trim($_REQUEST['fromRecordNo']);
    $toRecordNo = trim($_REQUEST['toRecordNo']);
    if (preg_match("/[^a-zA-Z\-']|^$/", $sitterType) || preg_match("/[^a-zA-Z0-9 \-']|^$/", $postcode) || preg_match("/[^0-9]+$/", $fromRecordNo) || preg_match("/[^0-9]+$/", $toRecordNo))
        die('<Sitters/>');
} else {
    die('<Sitters/>');
}

include '../XmlDom.php';
include '../XmlPublisher.php';

$lewishamServiceUrl = 'http://stuiis.cms.gre.ac.uk/am238/soa/lewisham/LewishamService.asmx/getAllLewishamPostsGivenSitterTypeAndPostcodeWithImagesWithPagination'
        . '?sitterType=' . $sitterType . '&postcode=' . $postcode . '&fromRecordNo=' . $fromRecordNo . '&toRecordNo=' . $toRecordNo;
$greenwichServiceUrl = 'http://stuweb.cms.gre.ac.uk/~am238/soa/greenwich/WebServices/getAllGreenwichPostsGivenSitterTypeAndPostcodeWithImagesWithPagination.php'
        . '?sitterType=' . $sitterType . '&postcode=' . $postcode . '&fromRecordNo=' . $fromRecordNo . '&toRecordNo=' . $toRecordNo;

publishXml(XmlDom::mergeXmlDoms(XmlDom::getXmlDom($lewishamServiceUrl), XmlDom::getXmlDom($greenwichServiceUrl)));
?>
