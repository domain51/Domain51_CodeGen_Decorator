<?php

require_once 'Domain51/CodeGen/Decorator/Method/Arguments.php';

class Domain51_CodeGen_Decorator_Method_Signature
{
    private $_method = null;
    
    public function __construct(ReflectionMethod $method)
    {
        $this->_method = $method;
    }
    
    public function __toString()
    {
        if ($this->_method->isPublic()) {
            $scope = 'public';
        } elseif ($this->_method->isProtected()) {
            $scope = 'protected';
        } else {
            return '';
        }
        
        $reference = $this->_method->returnsReference() ? '&' : '';
        
        $arguments = (string) new Domain51_CodeGen_Decorator_Method_Arguments($this->_method);
        return "{$scope} function {$reference}{$this->_method->getName()}({$arguments})";
    }
}