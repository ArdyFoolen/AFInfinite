<?php

namespace AFInfinite\Core;

class XmlParser {
    
    private $Parser;
    private IProcessingHandler $Handler;
    
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

    public function SetHandler(IProcessingHandler $handler) {
        $this->Handler = $handler;
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
        echo "Start: " . $tag . "<br/>";
        foreach ($attributes as $key => $value) {
            echo " Attr: " . $key . " => " . $value . "<br/>";
        }
    }
    
    private function EndHandler($parser, $tag) {
        echo "End:   " . $tag . "<br/>";
    }
    
    private function DataHandler($parser, $cdata) {
        echo "Data:  " . $cdata . "<br/>";
    }
    
    private function ProcessingHandler($parser, $target, $code) {
        if (isset($this->Handler)) {
            $this->Handler->Process($parser, $target, $code);
        }
    }
}
