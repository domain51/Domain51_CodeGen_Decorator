<?php

require_once 'Domain51/CodeGen/Decorator/Method/Signature.php';
require_once 'Domain51/CodeGen/Decorator/Method/Arguments.php';

class Domain51_CodeGen_Decorator_Method
{
    private $_method = null;
    private $_indention = null;
    
    public function __construct(ReflectionMethod $method)
    {
        $this->_method = $method;
    }
    
    public function __set($key, $value)
    {
        if ($key == 'indention') {
            $this->_indention = $value;
        }
    }
    
    public function __toString()
    {
        if (substr($this->_method->getName(), 0, 2) == '__') {
            return '';
        }
        
        $signature = (string)new Domain51_CodeGen_Decorator_Method_Signature($this->_method);
        $arguments = new Domain51_CodeGen_Decorator_Method_Arguments($this->_method);
        $arguments->short_mode = true;
        $code = "{$this->_indention}{$signature}\n" .
            "{$this->_indention}{\n" .
            "{$this->_indention}    return \$this->_decorated->{$this->_method->getName()}({$arguments});\n" .
            "{$this->_indention}}";
        return $code;
    }
}