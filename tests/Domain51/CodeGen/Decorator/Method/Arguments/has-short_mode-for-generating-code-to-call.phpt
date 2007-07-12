--TEST--
If short_mode property is set, the signature is generated the same way it would be for calling the
method: without type hinting or default values.
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
$method->short_mode = true;
echo $method . "\n";

$reflection = new ReflectionMethod('ASimpleClass', 'methodWithArrayTypeHintAndDefault');
$method = new Domain51_CodeGen_Decorator_Method_Arguments($reflection);
$method->short_mode = true;
echo $method . "\n";

$reflection = new ReflectionMethod('ASimpleClass', 'methodWithObjectTypeHint');
$method = new Domain51_CodeGen_Decorator_Method_Arguments($reflection);
$method->short_mode = true;
echo $method . "\n";

$reflection = new ReflectionMethod('ASimpleClass', 'methodWithObjectTypeHintAndDefault');
$method = new Domain51_CodeGen_Decorator_Method_Arguments($reflection);
$method->short_mode = true;
echo $method . "\n";

?>
===DONE===
--EXPECT--
$array
$array
$obj
$obj
===DONE===