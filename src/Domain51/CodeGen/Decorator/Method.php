<?php

require_once 'Domain51/CodeGen/Decorator/Method/Signature.php';
require_once 'Domain51/CodeGen/Decorator/Method/Arguments.php';

class Domain51_CodeGen_Decorator_Method
{
    private $_method = null;
    
    public function __construct($method)
    {
        $this->_method = $method;
    }
    
    public function __toString()
    {
        if (substr($this->_method->getName(), 0, 2) == '__') {
            return '';
        }
        
        $signature = new Domain51_CodeGen_Decorator_Method_Signature($this->_method);
        $arguments = (string)new Domain51_CodeGen_Decorator_Method_Arguments($this->_method);
        $code = (string)$signature . "\n" .
            "{\n" .
            "    return \$this->_decorated->{$this->_method->getName()}({$arguments});\n" .
            "}";
        return $code;
    }
}