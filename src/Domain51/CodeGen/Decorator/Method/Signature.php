<?php

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
        
        return "{$scope} function {$reference}{$this->_method->getName()}({$this->_parameters()})";
    }
    
    private function _parameters()
    {
        $prepared_parameters = array();
        foreach ($this->_method->getParameters() as $parameter) {
            $string = '';
            if ($parameter->isPassedByReference()) {
                $string .= '&';
            }
            $string .= "\${$parameter->getName()}";
            $prepared_parameters[] = $string;
        }
        
        return implode(", ", $prepared_parameters);
    }
}