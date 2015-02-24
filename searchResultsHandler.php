<?php

class searchResultsHandler {
    public static $RESULTS_PER_PAGE = 9;
    public static function sortSitterServicesByPriceAscending($sitterServices) {

        function cmpAsc($sitterServiceA, $sitterServiceB) {
            return $sitterServiceA->rate > $sitterServiceB->rate;
        }

        usort($sitterServices, "cmpAsc");
        return $sitterServices;
    }

    public static function sortSitterServicesByPriceDescending($sitterServices) {

        function cmpDesc($sitterServiceA, $sitterServiceB) {
            return $sitterServiceA->rate < $sitterServiceB->rate;
        }

        usort($sitterServices, "cmpDesc");
        return $sitterServices;
    }

    public static function getResultsSubsetByPage($sitterServices, $page) {
        $sitterServicesSubset = array();
        $iSitterService = ($page - 1) * searchResultsHandler::$RESULTS_PER_PAGE; // 9 Results per page, therefore page1 => (0 - 8), page2 => (9 - 17) etc
        while ($iSitterService < ($page * searchResultsHandler::$RESULTS_PER_PAGE) && $iSitterService < count($sitterServices)) {
            array_push($sitterServicesSubset, $sitterServices[$iSitterService]);
            $iSitterService++;
        }
        return $sitterServicesSubset;
    }

}

?>