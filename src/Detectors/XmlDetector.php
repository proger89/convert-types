<?php

namespace Proger89\ConvertTypes\Detectors;

use Proger89\ConvertTypes\TypeDetectorInterface;

class XmlDetector implements TypeDetectorInterface
{
    public function detect($data)
    {
        if (!is_string($data) || empty($data)) {
            return false;
        }
        libxml_use_internal_errors(true);
        simplexml_load_string($data);
        $errors = libxml_get_errors();
        libxml_clear_errors();

        return empty($errors);
    }
}
