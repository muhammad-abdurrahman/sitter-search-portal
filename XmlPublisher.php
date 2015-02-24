<?php

header('Content-type: text/xml');

function publishXml($xmlDom) {
    echo $xmlDom->saveXML();
}

?>