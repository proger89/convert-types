<?php
include_once 'vendor/autoload.php';

use XMLParser\XMLParser;
class Convert{
    const TYPE_JSON = 'Json';
    const TYPE_XML = 'Xml';
    const TYPE_HTML = 'Html';

    public function to($data,$format){
        $format = ucfirst(strtolower($format));
        $detectedType = $this->detectType($data);
        if($detectedType == $format) return $data;
        $methodName = "from".$detectedType."To".$format;

        return $this->{$methodName}($data);

    }
    private function fromXmlToJson($data){
        $xml = simplexml_load_string($data);
        return json_encode($xml);
    }

    private function fromJsonToXml($data){
        $array = json5_decode($data,true);
        $xml = XMLParser::encode( $array , 'response' );
        return $xml->asXML();
    }

    private function fromHtmlToJson($data){
        $html = new HtmlSerializer\Html($data);
        $html->parseCss(false);
        $html->removeEmptyStrings();
        return $html->toJson();
    }

    private function fromHtmlToXml($data){
        $html = new HtmlSerializer\Html($data);
        $html->parseCss(false);
        $html->removeEmptyStrings();
        return $this->fromJsonToXml($html->toJson());
    }

    private function detectType($data){
        if($this->isJson($data)){
            return self::TYPE_JSON;
        }
        if($this->isXML($data)){
            return self::TYPE_XML;
        }
        if($this->isHTML($data)){
            return self::TYPE_HTML;
        }
    }

    private function isJson($data) {
        json_decode($data);
        return json_last_error() === JSON_ERROR_NONE;
    }

    private function isXML($data) {
        libxml_use_internal_errors(true);
        simplexml_load_string($data);
        $errors = libxml_get_errors();
        libxml_clear_errors();

        return empty($errors);
    }
    private function isHTML($data) {
        if($data != strip_tags($data)) {
            return true;
        }
        return false;
    }
}