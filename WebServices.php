<?php

class WebServices {

    public static function getServices() {
        $serviceList = array(
            'getAllPostsGivenSitterTypeAndPostcode' => array(
                new Parameter('sitterType'),
                new Parameter('postcode')),
            'getAllPostsGivenSitterTypeAndPostcodeWithImages' => array(
                new Parameter('sitterType'),
                new Parameter('postcode')),
            'getAllPostsGivenSitterTypeAndPostcodeWithImagesWithPagination' => array(
                new Parameter('sitterType'),
                new Parameter('postcode'),
                new Parameter('fromRecordNo'),
                new Parameter('toRecordNo')),
            'getAllPostsGivenSitterTypeAndPostcodeWithPagination' => array(
                new Parameter('sitterType'),
                new Parameter('postcode'),
                new Parameter('fromRecordNo'),
                new Parameter('toRecordNo')),
            'getAllPostsGivenSitterTypeAndPostcodeWithoutImages' => array(
                new Parameter('sitterType'),
                new Parameter('postcode')),
            'getAllPostsWithImage' => array(),
            'getAllPostsWithoutImage' => array(),
            'getPostsById' => array(new Parameter('id')),
            'getPostsByPostcode' => array(new Parameter('postcode')),
            'getPostsByPrice' => array(new Parameter('price')),
            'getPostsSearchAll' => array(new Parameter('searchTerm')),
            'getPostsSearchAllWithPagination' => array(
                new Parameter('searchTerm'), 
                new Parameter('fromRecordNo'), 
                new Parameter('toRecordNo')),
            'getSittersById' => array(new Parameter('id')),
            'getSittersByType' => array(new Parameter('type'))
        );
         return $serviceList;
    }

}

class Parameter {

    public $name;

    public function __construct($name) {
        $this->name = $name;
    }

}

?>