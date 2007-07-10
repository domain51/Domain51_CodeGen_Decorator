--TEST--
Domain51_CodeGen_Decorator_Method is used to create the code that represents a method, in decorated
form.
--FILE--
<?php
// BEGIN REMOVE
set_include_path(dirname(__FILE__) . '/../../../../' . PATH_SEPARATOR.
                 dirname(__FILE__) . '/../../../../../src' . PATH_SEPARATOR .
                 get_include_path()
                );
// END REMOVE

require_once 'Domain51/CodeGen/Decorator/Method.php';

class ASimpleClass
{
    public function someMethod() { }
    public function someMethodWithAnArgument($argument) { }
}

$reflection = new ReflectionMethod('ASimpleClass', 'someMethod');
echo new Domain51_CodeGen_Decorator_Method($reflection) . "\n";

$reflection = new ReflectionMethod('ASimpleClass', 'someMethodWithAnArgument');
echo new Domain51_CodeGen_Decorator_Method($reflection) . "\n";

?>
===DONE===
--EXPECT--
public function someMethod()
{
    return $this->_decorated->someMethod();
}
public function someMethodWithAnArgument($argument)
{
    return $this->_decorated->someMethodWithAnArgument($argument);
}
===DONE===