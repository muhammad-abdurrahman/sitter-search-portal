<?php

include 'SitterService.php';

class xmlToSitterServiceParser {

    public static function getSitterServicesFromXml($xmlDom) {
        $sitterServices = array();

        if ($xmlDom->getElementsByTagName('Sitters')->item(0)->hasChildNodes()) {
            $sitters = $xmlDom->getElementsByTagName('Sitter');
            foreach ($sitters as $sitter) {
                $sitterService = new SitterService();

                $sitterService->postId = $sitter->getElementsByTagName('SitterService')->item(0)->getAttribute('id');
                $sitterService->borough = $sitter->getElementsByTagName('SitterService')->item(0)->getAttribute('borough');
                $sitterService->userId = $sitter->getAttribute('id');
                if ($sitter->getElementsByTagName('Username')->item(0) != NULL) {
                    $sitterService->username = $sitter->getElementsByTagName('Username')->item(0)->nodeValue;
                }
                if ($sitter->getElementsByTagName('EmailAddress')->item(0) != NULL) {
                    $sitterService->email = $sitter->getElementsByTagName('EmailAddress')->item(0)->nodeValue;
                }
                if ($sitter->getElementsByTagName('FullName')->item(0) != NULL) {
                    $sitterService->fullName = $sitter->getElementsByTagName('FullName')->item(0)->nodeValue;
                }
                if ($sitter->getElementsByTagName('SitterService')->item(0)
                                ->getElementsByTagName('Postcode')->item(0) != NULL) {
                    $sitterService->postcode = $sitter->getElementsByTagName('SitterService')->item(0)
                                    ->getElementsByTagName('Postcode')->item(0)->nodeValue;
                }
                if ($sitter->getElementsByTagName('SitterService')->item(0)
                                ->getElementsByTagName('Description')->item(0) != NULL) {
                    $sitterService->description = $sitter->getElementsByTagName('SitterService')->item(0)
                                    ->getElementsByTagName('Description')->item(0)->nodeValue;
                }
                if ($sitter->getElementsByTagName('SitterService')->item(0)
                                ->getElementsByTagName('Availability')->item(0) != NULL) {
                    $sitterService->availability = $sitter->getElementsByTagName('SitterService')->item(0)
                                    ->getElementsByTagName('Availability')->item(0)->nodeValue;
                }
                if ($sitter->getElementsByTagName('SitterService')->item(0)
                                ->getElementsByTagName('Rate')->item(0) != NULL) {
                    $sitterService->rate = $sitter->getElementsByTagName('SitterService')->item(0)
                                    ->getElementsByTagName('Rate')->item(0)->nodeValue;
                }
                if ($sitter->getElementsByTagName('SitterService')->item(0)
                                ->getElementsByTagName('CalloutCharge')->item(0) != NULL) {
                    $sitterService->calloutCharge = $sitter->getElementsByTagName('SitterService')->item(0)
                                    ->getElementsByTagName('CalloutCharge')->item(0)->nodeValue;
                }
                $sitterService->sittingType = $sitter->getElementsByTagName('SitterService')->item(0)->getAttribute('type');
                
                $imgs = array();
                if ($sitter->getElementsByTagName('SitterService')->item(0)
                                ->getElementsByTagName('ImageList')->item(0) != NULL) {
                    $imgs = $sitter->getElementsByTagName('SitterService')->item(0)
                                    ->getElementsByTagName('ImageList')->item(0)->getElementsByTagName('Image');
                }
                $images = array();
                foreach ($imgs as $img) {
                    $image = new Image();
                    $image->imageId = $img->getAttribute('id');
                    $image->url = $img->getElementsByTagName('Url')->item(0)->nodeValue;
                    $image->altText = $img->getElementsByTagName('AltText')->item(0)->nodeValue;
                    array_push($images, $image);
                }

                $sitterService->images = $images;

                array_push($sitterServices, $sitterService);
            }
        }

        return $sitterServices;
    }

}

?>
