--TEST--
It can properly decorate magic methods.  Note that __get() and __set() will always be present to
handle decorating properties.  __call() will only be present if it exists in the object, or the
Decorator has its $use_call property set to true.
--FILE--
<?php
// BEGIN REMOVE
set_include_path(dirname(__FILE__) . '/../../../' . PATH_SEPARATOR.
                 dirname(__FILE__) . '/../../../../src' . PATH_SEPARATOR .
                 get_include_path()
                );
// END REMOVE

require_once 'Domain51/CodeGen/Decorator.php';

class ASimpleClassWithMagicMethods
{
    public function __construct(Reflection $reflection) { }
    public function __destruct() { }
    public function __get($key) { }
    public function __set($key, $value) { }
}

echo new Domain51_CodeGen_Decorator('ASimpleClassWithMagicMethods') . "\n";

?>
===DONE===
--EXPECT--
class ASimpleClassWithMagicMethodsDecorator
{
    private $_decorated = null;

    public function __construct(ASimpleClassWithMagicMethods $decorated)
    {
        $this->_decorated = $decorated;
    }

    public function __destruct()
    {
        unset($this->_decorated);
    }

    public function __get($key)
    {
        return $this->_decorated->$key;
    }

    public function __set($key, $value)
    {
        $this->_decorated->$key = $value;
    }
}
===DONE===