<?php

require_once 'Domain51/CodeGen/Decorator/Method.php';

class Domain51_CodeGen_Decorator
{
    private $_reflection = null;
    private $_decorator_name = null;
    private $_magic_methods = array('__get', '__set', '__construct', '__destruct');
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
        
        $code = "class {$this->_decorator_name}\n" .
            "{\n" .
            "    private \$_decorated = null;\n" .
            "\n" .
            "    public function __construct({$this->_reflection->getName()} \$decorated)\n" .
            "    {\n" .
            "        \$this->_decorated = \$decorated;\n" .
            "    }\n" .
            "{$this->_generateDestruct()}" .
            "    public function __get(\$key)\n" .
            "    {\n" .
            "        return \$this->_decorated->\$key;\n" .
            "    }\n" .
            "\n" .
            "    public function __set(\$key, \$value)\n" .
            "    {\n" .
            "        \$this->_decorated->\$key = \$value;\n" .
            "    }\n" .
            "{$this->_generateMethods()}" .
            "}";
        return $code;
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
            $methods = array();
            foreach ($this->_reflection->getMethods() as $method) {
                if (in_array($method->getName(), $this->_magic_methods)) {
                    continue;
                }
                $decorated_method = new Domain51_CodeGen_Decorator_Method($method);
                $decorated_method->indention = '    ';
                $methods[] = (string)$decorated_method;
            }
            if (count($methods) == 0) {
                return '';
            }
            return "\n" . implode("\n\n", $methods) . "\n";
        }
    }
    
    private function _generateDestruct()
    {
        if (!$this->_reflection->hasMethod('__destruct')) {
            return "\n";
        }
        
        $code = "\n" . 
                "    public function __destruct()\n" .
                "    {\n" .
                "        unset(\$this->_decorated);\n" .
                "    }\n\n";
        return $code;
    }
}