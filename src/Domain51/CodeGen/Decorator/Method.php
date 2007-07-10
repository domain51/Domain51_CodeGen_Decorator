<?php

class Domain51_CodeGen_Decorator_Method
{
    private $_method = null;
    
    public function __construct($method)
    {
        $this->_method = $method;
    }
    
    public function __toString()
    {
        switch ($this->_method->getName()) {
            case 'message' :
                return "public function message() { return'Hello World!'; }";
            
            case 'random' :
                return "public function random() { return 'Random Number: ' . rand(100, 199); }";
            
            case 'methodWithArgument':
                return 'public function methodWithArgument() { }';
        }
        
        return '';
    }
}