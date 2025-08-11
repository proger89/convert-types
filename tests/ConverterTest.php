<?php

use PHPUnit\Framework\TestCase;
use Proger89\ConvertTypes\Converter;

class ConverterTest extends TestCase
{
    private $converter;

    protected function setUp(): void
    {
        $this->converter = new Converter();
    }

    public function testXmlToJsonConversion()
    {
        $xml = '<root><item>test</item></root>';
        $json = $this->converter->convert($xml, 'Json');
        $this->assertJsonStringEqualsJsonString('{"item":"test"}', $json);
    }

    public function testJsonToXmlConversion()
    {
        $json = '{"item":"test"}';
        $xml = $this->converter->convert($json, 'Xml');
        $this.self::assertXmlStringEqualsXmlString('<?xml version="1.0"?>
<response><item>test</item></response>
', $xml);
    }

    public function testHtmlToJsonConversion()
    {
        $html = '<html><body><p>test</p></body></html>';
        $json = $this->converter->convert($html, 'Json');
        $this->assertJson($json);
    }

    public function testHtmlToXmlConversion()
    {
        $html = '<html><body><p>test</p></body></html>';
        $xml = $this->converter->convert($html, 'Xml');
        $this->assertXml($xml);
    }

    public function testUnknownConversion()
    {
        $this->expectException(\Exception::class);
        $this->converter->convert('<xml></xml>', 'Yaml');
    }

    public function testUnknownDataType()
    {
        $this->expectException(\Exception::class);
        $this->converter->convert('just a string', 'Json');
    }
}
