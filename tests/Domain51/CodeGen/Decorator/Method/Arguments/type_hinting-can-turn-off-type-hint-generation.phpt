--TEST--
If the $type_hint property is set to false, a signature without type hinting will be generated.
This is used when generating the signature to pass to the actual method call.
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
    public function methodWithArrayTypeHintAndDefault(array $array = array()) { }
    
    public function methodWithObjectTypeHint(ASimpleClass $obj) { }
    public function methodWithObjectTypeHintAndDefault(ASimpleClass $obj = null) { }
}

$reflection = new ReflectionMethod('ASimpleClass', 'methodWithArrayTypeHint');
$method = new Domain51_CodeGen_Decorator_Method_Arguments($reflection);
$method->type_hint = false;
echo $method . "\n";

$reflection = new ReflectionMethod('ASimpleClass', 'methodWithArrayTypeHintAndDefault');
$method = new Domain51_CodeGen_Decorator_Method_Arguments($reflection);
$method->type_hint = false;
echo $method . "\n";

$reflection = new ReflectionMethod('ASimpleClass', 'methodWithObjectTypeHint');
$method = new Domain51_CodeGen_Decorator_Method_Arguments($reflection);
$method->type_hint = false;
echo $method . "\n";

$reflection = new ReflectionMethod('ASimpleClass', 'methodWithObjectTypeHintAndDefault');
$method = new Domain51_CodeGen_Decorator_Method_Arguments($reflection);
$method->type_hint = false;
echo $method . "\n";

?>
===DONE===
--EXPECT--
$array
$array = array()
$obj
$obj = null
===DONE===