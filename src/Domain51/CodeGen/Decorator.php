<?php

class Domain51_CodeGen_Decorator
{
    private $_reflection = null;
    private $_decorator_name = null;
    private $_use_call = false;
    
    public function __construct($param)
    {
        $this->_reflection = new ReflectionClass($param);
        $this->_decorator_name = $this->_reflection->getName() . 'Decorator';
    }
    
    public function __set($key, $value)
    {
        switch ($key) {
            case 'name' :
                $this->_decorator_name = $value;
                break;
            
            case 'use_call' :
                $this->_use_call = (bool)$value;
                break;
        }
    }
    
    public function __toString()
    {
        
        return "
        class {$this->_decorator_name} {
            private \$_decorated = null;
            
            public function __construct({$this->_reflection->getName()} \$decorated)
            {
                \$this->_decorated = \$decorated;
            }
            
            public function __get(\$key)
            {
                return \$this->_decorated->\$key;
            }
            
            public function __set(\$key, \$value)
            {
                \$this->_decorated->\$key = \$value;
            }
            
            {$this->_generateMethods()}
            }";
    }
    
    private function _generateMethods()
    {
        if ($this->_use_call) {
            return '
                public function __call($method, $arguments) {
                    return call_user_func_array(
                        array($this->_decorated, $method),
                        $arguments
                    );
                }';
        } else {
            return "
            public function message() { return'Hello World!'; }
            public function random() { return 'Random Number: ' . rand(100, 199); }";
        }
    }
}