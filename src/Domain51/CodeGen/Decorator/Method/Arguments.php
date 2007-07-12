<?php

class Domain51_CodeGen_Decorator_Method_Arguments
{
    private $_method = null;
    private $_short_arrays = false;
    private $_short_mode = false;
    
    public function __construct(ReflectionMethod $method)
    {
        $this->_method = $method;
    }
    
    public function __set($key, $value)
    {
        if ($key == 'short_mode') {
            $this->_short_mode = (bool)$value;
        }
    }
    
    public function __toString()
    {
        if ($this->_method->getNumberOfParameters() == 0) {
            return '';
        }
        
        $arguments = array();
        foreach ($this->_method->getParameters() as $parameter) {
            $code = '';
            if (!$this->_short_mode) {
                if ($parameter->isArray()) {
                    $code .= 'array ';
                } elseif (!is_null($parameter->getClass())) {
                    $code .= $parameter->getClass()->getName() . ' ';
                }
            }
            if ($parameter->isPassedByReference()) {
                $code .= '&';
            }
            $code .= '$' . $parameter->getName();
            
            if (!$this->_short_mode && $parameter->isDefaultValueAvailable()) {
                $code .= ' = ';
                $default = $parameter->getDefaultValue();
                if (is_array($default)) {
                    if (empty($default)) {
                        $code .= 'array()';
                    } else {
                        $values = array();
                        foreach ($default as $key => $value) {
                            if ($this->_short_arrays && !is_string($key)) {
                                $values[] = $value;
                            } else {
                                $values[] = $this->_dump($key) . ' => ' . $this->_dump($value);
                            }
                        }
                        $code .= 'array(' . implode(', ', $values) . ')';
                    }
                } else {
                    $code .= $this->_dump($default);
                }
            }
            $arguments[] = $code;
        }
        
        return implode(', ', $arguments);
    }
    
    private function _dump($value)
    {
        if (is_string($value)) {
            return "'{$value}'";
        }        
        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }
        if (is_null($value)) {
            return 'null';
        }
        
        return $value;
    }
}