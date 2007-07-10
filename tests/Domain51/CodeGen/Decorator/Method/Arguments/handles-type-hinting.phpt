--TEST--
Can handle methods that have type hinting
--FILE--
<?php
// BEGIN REMOVE
set_include_path(dirname(__FILE__) . '/../../../../../' . PATH_SEPARATOR.
                 dirname(__FILE__) . '/../../../../../../src' . PATH_SEPARATOR .
                 get_include_path()
                );
// END REMOVE

require_once 'Domain51/CodeGen/Decorator/Method/Arguments.php';

class ASimpleClass
{
    public function methodWithArrayTypeHint(array $array) { }
    public function methodWithObjectTypeHint(ASimpleClass $object) { }
}

$reflection = new ReflectionMethod('ASimpleClass', 'methodWithArrayTypeHint');
echo new Domain51_CodeGen_Decorator_Method_Arguments($reflection) . "\n";

$reflection = new ReflectionMethod('ASimpleClass', 'methodWithObjectTypeHint');
echo new Domain51_CodeGen_Decorator_Method_Arguments($reflection) . "\n";

?>
===DONE===
--EXPECT--
array $array
ASimpleClass $object
===DONE===