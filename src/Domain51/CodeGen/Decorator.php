<?php

class Domain51_CodeGen_Decorator
{
    private $_reflection = null;
    private $_decorator_name = null;
    
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
        }
    }
    
    public function __toString()
    {
        
        return "
        class {$this->_decorator_name} {
            private \$_decoratored = null;
            
            public function __construct({$this->_reflection->getName()} \$decorated)
            {
                \$this->_decoratored = \$decorated;
            }
            
            public function __get(\$key)
            {
                return \$this->_decoratored->\$key;
            }
            
            public function __set(\$key, \$value)
            {
                \$this->_decoratored->\$key = \$value;
            }
            
            public function message() { return'Hello World!'; }
            public function random() { return 'Random Number: ' . rand(100, 199); }
            }";
    }
}