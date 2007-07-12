--TEST--
This can properly handle a type hinted method by decorating the signature properly
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
    public function methodWithTypeHint(ASimpleClass $obj) { }
    public function methodWithTypeHintAndDefault(ASimpleClass $obj = null) { }
}

$reflection = new ReflectionMethod('ASimpleClass', 'methodWithTypeHint');
echo new Domain51_CodeGen_Decorator_Method($reflection) . "\n";

$reflection = new ReflectionMethod('ASimpleClass', 'methodWithTypeHintAndDefault');
echo new Domain51_CodeGen_Decorator_Method($reflection) . "\n";


?>
===DONE===
--EXPECT--
public function methodWithTypeHint(ASimpleClass $obj)
{
    return $this->_decorated->methodWithTypeHint($obj);
}
public function methodWithTypeHintAndDefault(ASimpleClass $obj = null)
{
    return $this->_decorated->methodWithTypeHintAndDefault($obj);
}
===DONE===