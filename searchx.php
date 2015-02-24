<?php

session_start();
//if (isset($_POST['search'])) {
$sitterType = $_POST['sitterType'];
$postcode = $_POST['postcode'];
$radius = $_POST['sitterType'];
$isExcludeImageCheck = isset($_POST['excludeImageCheck']);
$sortOptions = $_POST['sortOptions'];

//$page = $_GET['p'];
//$fromRecordNo; $toRecordNo;
//if($page < 2){
//    $fromRecordNo = 1;
//    $toRecordNo = 9;
//} else {
//    $fromRecordNo = (($page - 1) * 9) + 1;
//    $toRecordNo = $fromRecordNo + 9;
//}


//    if (empty($_POST['postcode'])) {
//        header('Location: searchx.php?error=true');
//        exit;
//    } else {


//       //With Pagination
//        $webServiceUrl;
//        if ($isExcludeImageCheck) {
//            $webServiceUrl = 'http://stu-nginx.cms.gre.ac.uk/~am238/WebServices/getAllPostsGivenSitterTypeAndPostcodeWithImagesWithPagination.php?sitterType=' . $sitterType . '&postcode=' . $postcode . '&fromRecordNo=1&toRecordNo=9';
//        } else {
//            $webServiceUrl = 'http://stu-nginx.cms.gre.ac.uk/~am238/WebServices/getAllPostsGivenSitterTypeAndPostcodeWithPagination.php?sitterType=' . $sitterType . '&postcode=' . $postcode . '&fromRecordNo=1&toRecordNo=9';
//        }

        $webServiceUrl;
        if ($isExcludeImageCheck) {
            $webServiceUrl = 'http://stu-nginx.cms.gre.ac.uk/~am238/WebServices/getAllPostsGivenSitterTypeAndPostcodeWithImages.php?sitterType=' . $sitterType . '&postcode=' . $postcode;
        } else {
            $webServiceUrl = 'http://stu-nginx.cms.gre.ac.uk/~am238/WebServices/getAllPostsGivenSitterTypeAndPostcode.php?sitterType=' . $sitterType . '&postcode=' . $postcode;
        }

include_once 'XmlDom.php';
$xmlSitterServicesDom = XmlDom::getXmlDom($webServiceUrl);

//        $sitterServices = xmlToSitterServiceParser::getSitterServicesFromXml($xmlSitterServicesDom);
//        include './searchResultsHandler.php';
//
//        if ($sortOptions == 'asc') {
//            $sitterServices = searchResultsHandler::sortSitterServicesByPriceAscending($sitterServices);
//        } else {
//            $sitterServices = searchResultsHandler::sortSitterServicesByPriceDescending($sitterServices);
//        }
//        $_SESSION['sitterServices'] = $sitterServices;
//        $_SESSION['sitterServicesSubset'] = searchResultsHandler::getResultsSubsetByPage($sitterServices, 1);
# START XSLT
$xslt = new XSLTProcessor();
$xsl = new DOMDocument();
$xsl->load('search.xsl', LIBXML_NOCDATA);
$xslt->importStylesheet($xsl);

print $xslt->transformToXML($xmlSitterServicesDom);
//    }
//} 
?>


