--TEST--
Can handle default values when specified.  Note that arrays are specified in long form, so a
default value of "array(123)" becomes "array(0 => 123)".
--FILE--
<?php
// BEGIN REMOVE
set_include_path(dirname(__FILE__) . '/../../../../../' . PATH_SEPARATOR.
                 dirname(__FILE__) . '/../../../../../../src' . PATH_SEPARATOR .
                 get_include_path()
                );
// END REMOVE

require_once 'Domain51/CodeGen/Decorator/Method/Arguments.php';

class ASimpleObject
{
    public function withDefaultValue($int = 123) { }
    public function withString($string = "hello world") { }
    public function withEmptyArray($array = array()) { }
    public function withArray($array = array(123, 321)) { }
    public function withAssociativeArray($array = array('foo' => 'bar')) { }
    public function withTrueBool($true = true) { }
    public function withFalseBool($false = false) { }
    public function withNull($null = null) { }
    public function withTypeHintOrNull(ASimpleObject $obj = null) { }
}

$reflection = new ReflectionMethod('ASimpleObject', 'withDefaultValue');
echo new Domain51_CodeGen_Decorator_Method_Arguments($reflection) . "\n";

$reflection = new ReflectionMethod('ASimpleObject', 'withString');
echo new Domain51_CodeGen_Decorator_Method_Arguments($reflection) . "\n";

$reflection = new ReflectionMethod('ASimpleObject', 'withEmptyArray');
echo new Domain51_CodeGen_Decorator_Method_Arguments($reflection) . "\n";

$reflection = new ReflectionMethod('ASimpleObject', 'withArray');
echo new Domain51_CodeGen_Decorator_Method_Arguments($reflection) . "\n";

$reflection = new ReflectionMethod('ASimpleObject', 'withAssociativeArray');
echo new Domain51_CodeGen_Decorator_Method_Arguments($reflection) . "\n";

$reflection = new ReflectionMethod('ASimpleObject', 'withTrueBool');
echo new Domain51_CodeGen_Decorator_Method_Arguments($reflection) . "\n";

$reflection = new ReflectionMethod('ASimpleObject', 'withFalseBool');
echo new Domain51_CodeGen_Decorator_Method_Arguments($reflection) . "\n";

$reflection = new ReflectionMethod('ASimpleObject', 'withNull');
echo new Domain51_CodeGen_Decorator_Method_Arguments($reflection) . "\n";

$reflection = new ReflectionMethod('ASimpleObject', 'withTypeHintOrNull');
echo new Domain51_CodeGen_Decorator_Method_Arguments($reflection) . "\n";

?>
===DONE===
--EXPECT--
$int = 123
$string = 'hello world'
$array = array()
$array = array(0 => 123, 1 => 321)
$array = array('foo' => 'bar')
$true = true
$false = false
$null = null
ASimpleObject $obj = null
===DONE===