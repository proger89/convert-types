<?php

namespace Proger89\ConvertTypes\Converters;

use Proger89\ConvertTypes\ConverterInterface;
use HtmlSerializer\Html;

class HtmlToJsonConverter implements ConverterInterface
{
    public function convert($data)
    {
        $html = new Html($data);
        $html->parseCss(false);
        $html->removeEmptyStrings();
        return $html->toJson();
    }
}
