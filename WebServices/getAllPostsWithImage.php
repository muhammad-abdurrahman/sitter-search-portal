<?php
header('Content-type: text/xml');

include '../XmlDom.php';
include '../XmlPublisher.php';

$lewishamServiceUrl = 'http://stuiis.cms.gre.ac.uk/am238/soa/lewisham/LewishamService.asmx/getAllLewishamPostsWithImage';
$greenwichServiceUrl = 'http://stuweb.cms.gre.ac.uk/~am238/soa/greenwich/WebServices/getAllGreenwichPostsWithImage.php';

publishXml(XmlDom::mergeXmlDoms(XmlDom::getXmlDom($lewishamServiceUrl), XmlDom::getXmlDom($greenwichServiceUrl)));

?>
