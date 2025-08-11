<?php

namespace Proger89\ConvertTypes\Converters;

use Proger89\ConvertTypes\ConverterInterface;

class XmlToJsonConverter implements ConverterInterface
{
    public function convert($data)
    {
        $xml = simplexml_load_string($data);
        return json_encode($xml);
    }
}
