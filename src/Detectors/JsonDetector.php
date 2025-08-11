<?php

namespace Proger89\ConvertTypes\Detectors;

use Proger89\ConvertTypes\TypeDetectorInterface;

class JsonDetector implements TypeDetectorInterface
{
    public function detect($data)
    {
        if (!is_string($data) || empty($data)) {
            return false;
        }
        $decoded = json5_decode($data);
        return !is_null($decoded);
    }
}
