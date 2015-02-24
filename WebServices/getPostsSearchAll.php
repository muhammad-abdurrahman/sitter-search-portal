<?php

header('Content-type: text/xml');
if (isset($_REQUEST['searchTerm'])) { //accept POST and GET REST
    $searchTerm = trim($_REQUEST['searchTerm']);
    if (preg_match("/[^a-zA-Z0-9 \-']|^$/", $searchTerm)) {
        die('<Sitters/>');
    }
    $searchTerm = str_replace(' ', '+', $searchTerm);
} else {
    die('<Sitters/>');
}

include '../XmlDom.php';
include '../XmlPublisher.php';

$lewishamServiceUrl = 'http://stuiis.cms.gre.ac.uk/am238/soa/lewisham/LewishamService.asmx/getLewishamPostsSearchAll?searchTerm=' . $searchTerm;
$greenwichServiceUrl = 'http://stuweb.cms.gre.ac.uk/~am238/soa/greenwich/WebServices/getGreenwichPostsSearchAll.php?searchTerm=' . $searchTerm;

publishXml(XmlDom::mergeXmlDoms(XmlDom::getXmlDom($lewishamServiceUrl), XmlDom::getXmlDom($greenwichServiceUrl)));
?>