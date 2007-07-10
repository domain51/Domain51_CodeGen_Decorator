--TEST--
This will prefix an argument with "&" if it is to be passed in by reference
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
    public function noRefernce($no_ref) { }
    public function methodHasReference(&$ref) { }
}

$reflection = new ReflectionMethod('ASimpleClass', 'noRefernce');
echo new Domain51_CodeGen_Decorator_Method_Arguments($reflection) . "\n";

$reflection = new ReflectionMethod('ASimpleClass', 'methodHasReference');
echo new Domain51_CodeGen_Decorator_Method_Arguments($reflection) . "\n";


?>
===DONE===
--EXPECT--
$no_ref
&$ref
===DONE===