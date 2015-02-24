<?php

session_start();
if (isset($_POST['search'])) {
    $sitterType = $_POST['sitterType'];
    $postcode = $_POST['postcode'];
    $radius = $_POST['sitterType'];
    $isExcludeImageCheck = isset($_POST['excludeImageCheck']);
    $sortOptions = $_POST['sortOptions'];

    if (empty($_POST['postcode'])) {
        header('Location: search.php?error=true');
    } else {
        include 'XmlDom.php';
        include 'xmlToSitterServiceParser.php';

////      WithPagination
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

        $xmlSitterServicesDom = XmlDom::getXmlDom($webServiceUrl);

        $sitterServices = xmlToSitterServiceParser::getSitterServicesFromXml($xmlSitterServicesDom);
        include './searchResultsHandler.php';

        if ($sortOptions == 'asc') {
            $sitterServices = searchResultsHandler::sortSitterServicesByPriceAscending($sitterServices);
        } else {
            $sitterServices = searchResultsHandler::sortSitterServicesByPriceDescending($sitterServices);
        }
        $_SESSION['sitterServices'] = $sitterServices;
        $_SESSION['sitterServicesSubset'] = searchResultsHandler::getResultsSubsetByPage($sitterServices, 1);

        header('Location: search.php?p=1&res=true');
    }
}
?>