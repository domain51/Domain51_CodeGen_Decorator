<?php

class Domain51_CodeGen_Decorator
{
    private $_name = null;
    
    public function __construct($param)
    {
        $reflection = new ReflectionClass($param);
        $this->_name = $reflection->getName() . 'Decorator';
    }
    
    public function __set($key, $value)
    {
        switch ($key) {
            case 'name' :
                $this->_name = $value;
                break;
        }
    }
    
    public function __toString()
    {
        
        return "class {$this->_name} {
            public function __construct(ASimpleObject \$decorated) { }
            public function message() { return'Hello World!'; }
            public function random() { return 'Random Number: ' . rand(100, 199); }
            }";
    }
}