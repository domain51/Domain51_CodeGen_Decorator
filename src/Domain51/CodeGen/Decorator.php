<?php

require_once 'Domain51/CodeGen/Decorator/Method.php';

class Domain51_CodeGen_Decorator
{
    private $_reflection = null;
    private $_decorator_name = null;
    private $_magic_methods = array('__get', '__set', '__construct', '__destruct');
    private $_use_call = false;
    private $_indention = '';
    
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
            
            case 'indention' :
                $this->_indention = $value;
                break;
        }
    }
    
    public function __toString()
    {
        
        $code = "{$this->_indention}class {$this->_decorator_name}\n" .
            "{$this->_indention}{\n" .
            "{$this->_indention}    private \$_decorated = null;\n" .
            "{$this->_indention}\n" .
            "{$this->_indention}    public function __construct({$this->_reflection->getName()} \$decorated)\n" .
            "{$this->_indention}    {\n" .
            "{$this->_indention}        \$this->_decorated = \$decorated;\n" .
            "{$this->_indention}    }\n" .
            "{$this->_indention}{$this->_generateDestruct()}" .
            "{$this->_indention}    public function __get(\$key)\n" .
            "{$this->_indention}    {\n" .
            "{$this->_indention}        return \$this->_decorated->\$key;\n" .
            "{$this->_indention}    }\n" .
            "{$this->_indention}\n" .
            "{$this->_indention}    public function __set(\$key, \$value)\n" .
            "{$this->_indention}    {\n" .
            "{$this->_indention}        \$this->_decorated->\$key = \$value;\n" .
            "{$this->_indention}    }\n" .
            "{$this->_generateMethods()}" .
            "{$this->_indention}}";
        return $code;
    }
    
    private function _generateMethods()
    {
        if ($this->_use_call) {
            return "{$this->_indention}\n" .
                   "{$this->_indention}    public function __call(\$method, \$arguments)\n" .
                   "{$this->_indention}    {\n" .
                   "{$this->_indention}        return call_user_func_array(\n" .
                   "{$this->_indention}            array(\$this->_decorated, \$method),\n" .
                   "{$this->_indention}            \$arguments\n" .
                   "{$this->_indention}        );\n" .
                   "{$this->_indention}    }\n";
        } else {
            $methods = array();
            $method_indention = empty($this->_indention) ?
                '    ' :
                $this->_indention . $this->_indention;
            
            foreach ($this->_reflection->getMethods() as $method) {
                if (in_array($method->getName(), $this->_magic_methods)) {
                    continue;
                }
                $decorated_method = new Domain51_CodeGen_Decorator_Method($method);
                $decorated_method->indention = $method_indention;
                $methods[] = (string)$decorated_method;
            }
            if (count($methods) == 0) {
                return '';
            }
            return "{$this->_indention}\n" . implode("\n\n", $methods) . "\n";
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