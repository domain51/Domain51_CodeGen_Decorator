--TEST--
When a Domain51_CodeGen_Decorator_Method_Signature is cast to a string, it represents the signature
of that given method.  It will return an empty string when the method passed to it is a private
method.
--FILE--
<?php
// BEGIN REMOVE
set_include_path(dirname(__FILE__) . '/../../../../../' . PATH_SEPARATOR.
                 dirname(__FILE__) . '/../../../../../../src' . PATH_SEPARATOR .
                 get_include_path()
                );
// END REMOVE

require_once 'Domain51/CodeGen/Decorator/Method/Signature.php';

class ASimpleObject
{
    public function publicMethod() { }
    protected function protectedMethod() { }
    private function privateMethod() { }
}

$reflection = new ReflectionMethod('ASimpleObject', 'publicMethod');
$generator = new Domain51_CodeGen_Decorator_Method_Signature($reflection);
echo $generator . "\n";

$reflection = new ReflectionMethod('ASimpleObject', 'protectedMethod');
$generator = new Domain51_CodeGen_Decorator_Method_Signature($reflection);
echo $generator . "\n";

$reflection = new ReflectionMethod('ASimpleObject', 'privateMethod');
$generator = new Domain51_CodeGen_Decorator_Method_Signature($reflection);
assert('(string)$generator == ""');


?>
===DONE===
--EXPECT--
public function publicMethod()
protected function protectedMethod()
===DONE===