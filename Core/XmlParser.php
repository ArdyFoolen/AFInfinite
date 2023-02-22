<?php

namespace AFInfinite\Core;

class XmlParser {
    
    private $Parser;
    
    public const StartEvent = "Start";
    public const EndEvent = "End";
    public const DataEvent = "Data";
    public const ProcessEvent = "Process";
    private array $EventHandler = [];

    public function __construct() {
        $this->Parser = xml_parser_create();
        
        xml_set_object($this->Parser, $this);
        xml_set_element_handler($this->Parser, "StartHandler", "EndHandler");
        xml_set_character_data_handler($this->Parser, "DataHandler");
        xml_set_processing_instruction_handler($this->Parser, "ProcessingHandler");
    }
    
    public function __destruct() {
        xml_parser_free($this->Parser);
        unset($this->Parser);
    }

    public function SetHandler(string $key, IProcessingHandler $handler) {
        $this->EventHandler[$key] = $handler;
    }
    
    public function Parse($xmlData) {
        xml_parse($this->Parser, $xmlData);
    }

    public function ParseFile($filePath) {
        $stream = fopen($filePath, 'r');
        while ($xmlData = fread($stream, 16384)) {
            xml_parse($this->Parser, $xmlData);
        }
        xml_parse($this->Parser, '', true);
        fclose($stream);
    }
    
    private function StartHandler($parser, $tag, $attributes) {
        if (isset($this->EventHandler[XmlParser::StartEvent])) {
            $this->EventHandler[XmlParser::StartEvent]->StartHandler($parser, $tag, $attributes);
        }
    }
    
    private function EndHandler($parser, $tag) {
        if (isset($this->EventHandler[XmlParser::EndEvent])) {
            $this->EventHandler[XmlParser::EndEvent]->EndHandler($parser, $tag);
        }
    }
    
    private function DataHandler($parser, $cdata) {
        if (isset($this->EventHandler[XmlParser::DataEvent])) {
            $this->EventHandler[XmlParser::DataEvent]->DataHandler($parser, $cdata);
        }
    }
    
    private function ProcessingHandler($parser, $target, $code) {
        if (isset($this->EventHandler[XmlParser::ProcessEvent])) {
            $this->EventHandler[XmlParser::ProcessEvent]->Process($parser, $target, $code);
        }
    }
}
