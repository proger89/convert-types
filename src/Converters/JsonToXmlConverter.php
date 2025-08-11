<?php

namespace Proger89\ConvertTypes\Converters;

use Proger89\ConvertTypes\ConverterInterface;
use XMLParser\XMLParser;

class JsonToXmlConverter implements ConverterInterface
{
    public function convert($data)
    {
        $array = json5_decode($data, true);
        $xml = XMLParser::encode($array, 'response');
        return $xml->asXML();
    }
}
