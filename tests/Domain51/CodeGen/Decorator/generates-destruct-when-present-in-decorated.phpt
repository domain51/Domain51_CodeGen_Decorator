--TEST--
If the class to be decorated has a __destruct() method, a __destruct() method is added to the
Decorator to unset the decorated object.
--FILE--
<?php
// BEGIN REMOVE
set_include_path(dirname(__FILE__) . '/../../../' . PATH_SEPARATOR.
                 dirname(__FILE__) . '/../../../../src' . PATH_SEPARATOR .
                 get_include_path()
                );
// END REMOVE

require_once 'Domain51/CodeGen/Decorator.php';

class ASimpleClass { }
class ASimpleClassWithDestruct
{
    public function __destruct() { }
}

eval(new Domain51_CodeGen_Decorator('ASimpleClass'));
$reflection = new ReflectionClass('ASimpleClassDecorator');
assert('!$reflection->hasMethod("__destruct")');

eval(new Domain51_CodeGen_Decorator('ASimpleClassWithDestruct'));
$reflection = new ReflectionClass('ASimpleClassWithDestructDecorator');
assert('$reflection->hasMethod("__destruct")');

?>
===DONE===
--EXPECT--
===DONE===