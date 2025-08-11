<?php

namespace Proger89\ConvertTypes\Converters;

use Proger89\ConvertTypes\ConverterInterface;
use HtmlSerializer\Html;

class HtmlToXmlConverter implements ConverterInterface
{
    public function convert($data)
    {
        $html = new Html($data);
        $html->parseCss(false);
        $html->removeEmptyStrings();
        $json = $html->toJson();

        // Now convert the JSON to XML
        $jsonToXmlConverter = new JsonToXmlConverter();
        return $jsonToXmlConverter->convert($json);
    }
}
