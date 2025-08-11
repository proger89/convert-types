<?php

namespace Proger89\ConvertTypes;

use Proger89\ConvertTypes\Converters\HtmlToJsonConverter;
use Proger89\ConvertTypes\Converters\HtmlToXmlConverter;
use Proger89\ConvertTypes\Converters\JsonToXmlConverter;
use Proger89\ConvertTypes\Converters\XmlToJsonConverter;
use Proger89\ConvertTypes\Detectors\HtmlDetector;
use Proger89\ConvertTypes\Detectors\JsonDetector;
use Proger89\ConvertTypes\Detectors\XmlDetector;

class Converter
{
    private $detectors = [];
    private $converters = [];

    public function __construct()
    {
        $this->addDetector('Json', new JsonDetector());
        $this->addDetector('Xml', new XmlDetector());
        $this->addDetector('Html', new HtmlDetector());

        $this->addConverter('Xml', 'Json', new XmlToJsonConverter());
        $this->addConverter('Json', 'Xml', new JsonToXmlConverter());
        $this->addConverter('Html', 'Json', new HtmlToJsonConverter());
        $this->addConverter('Html', 'Xml', new HtmlToXmlConverter());
    }

    public function addDetector($type, TypeDetectorInterface $detector)
    {
        $this->detectors[$type] = $detector;
    }

    public function addConverter($from, $to, ConverterInterface $converter)
    {
        $this->converters[$from][$to] = $converter;
    }

    public function convert($data, $to)
    {
        $from = $this->detectType($data);

        $to = ucfirst(strtolower($to));

        if ($from === $to) {
            return $data;
        }

        if (!isset($this->converters[$from][$to])) {
            throw new \Exception("Converter from {$from} to {$to} not found.");
        }

        return $this->converters[$from][$to]->convert($data);
    }

    private function detectType($data)
    {
        foreach ($this->detectors as $type => $detector) {
            if ($detector->detect($data)) {
                return $type;
            }
        }

        throw new \Exception("Could not detect data type.");
    }
}