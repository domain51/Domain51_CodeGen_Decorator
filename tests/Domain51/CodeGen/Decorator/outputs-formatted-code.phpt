--TEST--
The generated Decorator is formatted to the PEAR formatting  style
--FILE--
<?php
// BEGIN REMOVE
set_include_path(dirname(__FILE__) . '/../../../' . PATH_SEPARATOR.
                 dirname(__FILE__) . '/../../../../src' . PATH_SEPARATOR .
                 get_include_path()
                );
// END REMOVE

require_once 'Domain51/CodeGen/Decorator.php';

class ASimpleClass
{
    public function someMethod() { }
    public function someMethodWithParameter($param) { }
}

echo new Domain51_CodeGen_Decorator('ASimpleClass') . "\n";

?>
===DONE===
--EXPECT--
class ASimpleClassDecorator
{
    private $_decorated = null;

    public function __construct(ASimpleClass $decorated)
    {
        $this->_decorated = $decorated;
    }

    public function __get($key)
    {
        return $this->_decorated->$key;
    }

    public function __set($key, $value)
    {
        $this->_decorated->$key = $value;
    }

    public function someMethod()
    {
        return $this->_decorated->someMethod();
    }

    public function someMethodWithParameter($param)
    {
        return $this->_decorated->someMethodWithParameter($param);
    }
}
===DONE===