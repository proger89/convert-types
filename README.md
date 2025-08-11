# Convert Types Data

A flexible and extensible library for converting data between different formats.

## Supported Conversions

*   XML -> JSON
*   JSON -> XML
*   HTML -> JSON
*   HTML -> XML

## Installation

```bash
composer require proger89/convert-types
```

## Usage

### Basic Conversion

To convert data, create an instance of the `Converter` class and use the `convert` method. The library will automatically detect the input data type.

```php
use Proger89\ConvertTypes\Converter;

$converter = new Converter();

// Convert HTML to JSON
$html = '<html><body><p>Hello World</p></body></html>';
$json = $converter->convert($html, 'Json');
echo $json;

// Convert JSON to XML
$json = '{"user": {"name": "John Doe", "email": "john.doe@example.com"}}';
$xml = $converter->convert($json, 'Xml');
echo $xml;
```

### Extending the Library

The library is designed to be easily extensible. You can add your own converters and type detectors.

#### Adding a New Converter

To add a new converter, create a class that implements the `ConverterInterface` and register it with the `Converter` instance.

```php
use Proger89\ConvertTypes\Converter;
use Proger89\ConvertTypes\ConverterInterface;

// 1. Create your custom converter
class YamlToJsonConverter implements ConverterInterface
{
    public function convert($data)
    {
        // Your conversion logic here...
        return json_encode(yaml_parse($data));
    }
}

// 2. Register your converter
$converter = new Converter();
$converter->addConverter('Yaml', 'Json', new YamlToJsonConverter());

// 3. Use it!
$yaml = "user:\n  name: Jane Doe\n  email: jane.doe@example.com";
$json = $converter->convert($yaml, 'Json');
echo $json;
```

#### Adding a New Type Detector

To add a new type detector, create a class that implements the `TypeDetectorInterface` and register it.

```php
use Proger89\ConvertTypes\Converter;
use Proger89\ConvertTypes\TypeDetectorInterface;

// 1. Create your custom detector
class YamlDetector implements TypeDetectorInterface
{
    public function detect($data)
    {
        // Your detection logic here...
        // For example, check for common YAML syntax
        return is_string($data) && (strpos($data, ': ') !== false);
    }
}

// 2. Register your detector
$converter = new Converter();
$converter->addDetector('Yaml', new YamlDetector());

// Now the converter can auto-detect YAML data
```

## Running Tests

```bash
./vendor/bin/phpunit
```