--TEST--
Can create signatures for code that returns by reference
--FILE--
<?php
// BEGIN REMOVE
set_include_path(dirname(__FILE__) . '/../../../../../' . PATH_SEPARATOR.
                 dirname(__FILE__) . '/../../../../../../src' . PATH_SEPARATOR .
                 get_include_path()
                );
// END REMOVE

require_once 'Domain51/CodeGen/Decorator/Method/Signature.php';

class ASimpleClass
{
    public function &publicReturnReference() { }
    protected function &protectedReturnReference() { }
}

$reflection = new ReflectionMethod('ASimpleClass', 'publicReturnReference');
echo new Domain51_CodeGen_Decorator_Method_Signature($reflection) . "\n";

$reflection = new ReflectionMethod('ASimpleClass', 'protectedReturnReference');
echo new Domain51_CodeGen_Decorator_Method_Signature($reflection) . "\n";

?>
===DONE===
--EXPECT--
public function &publicReturnReference()
protected function &protectedReturnReference()
===DONE===