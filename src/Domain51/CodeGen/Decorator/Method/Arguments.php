<?php

class Domain51_CodeGen_Decorator_Method_Arguments
{
    private $_method = null;
    
    public function __construct(ReflectionMethod $method)
    {
        $this->_method = $method;
    }
    
    public function __toString()
    {
        if ($this->_method->getNumberOfParameters() == 0) {
            return '';
        }
        
        $arguments = array();
        foreach ($this->_method->getParameters() as $parameter) {
            $code = '';
            if ($parameter->isPassedByReference()) {
                $code .= '&';
            }
            $code .= '$' . $parameter->getName();
            $arguments[] = $code;
        }
        
        return implode(', ', $arguments);
    }
}