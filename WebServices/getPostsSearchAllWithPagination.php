<?php

header('Content-type: text/xml');
if (isset($_REQUEST['searchTerm']) && isset($_REQUEST['fromRecordNo']) && isset($_REQUEST['toRecordNo'])) { //accept POST and GET REST
    $searchTerm = trim($_REQUEST['searchTerm']);
    $fromRecordNo = trim($_REQUEST['fromRecordNo']);
    $toRecordNo = trim($_REQUEST['toRecordNo']);
    if (preg_match("/[^a-zA-Z0-9 \-']|^$/", $searchTerm) 
            || preg_match("/[^0-9]+$/", $fromRecordNo) 
            || preg_match("/[^0-9]+$/", $toRecordNo)) {
        die('<Sitters/>');
    }
    $searchTerm = str_replace(' ', '+', $searchTerm);
} else {
    die('<Sitters/>');
}

include '../XmlDom.php';
include '../XmlPublisher.php';

$lewishamServiceUrl = 'http://stuiis.cms.gre.ac.uk/am238/soa/lewisham/LewishamService.asmx/getLewishamPostsSearchAllWithPagination'
        . '?searchTerm='.$searchTerm.'&fromRecordNo='.$fromRecordNo.'&toRecordNo='.$toRecordNo;
$greenwichServiceUrl = 'http://stuweb.cms.gre.ac.uk/~am238/soa/greenwich/WebServices/getGreenwichPostsSearchAllWithPagination.php'
        . '?searchTerm='.$searchTerm.'&fromRecordNo='.$fromRecordNo.'&toRecordNo='.$toRecordNo;

publishXml(XmlDom::mergeXmlDoms(XmlDom::getXmlDom($lewishamServiceUrl), XmlDom::getXmlDom($greenwichServiceUrl)));
?>