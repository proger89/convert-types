<?php

namespace Proger89\ConvertTypes\Detectors;

use Proger89\ConvertTypes\TypeDetectorInterface;

class HtmlDetector implements TypeDetectorInterface
{
    public function detect($data)
    {
        if (!is_string($data) || empty($data)) {
            return false;
        }
        // A simple check for the presence of html tags.
        // This is not foolproof, but it's better than the original.
        return $data != strip_tags($data);
    }
}
