--TEST--
Can properly handle arguments of the method it is generating
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
    public function methodWithParameter($parameter) { }
    public function methodWithMultipleParameters($one, $two) { }
}

$reflection = new ReflectionMethod('ASimpleObject', 'methodWithParameter');
$signature = new Domain51_CodeGen_Decorator_Method_Signature($reflection);
echo $signature . "\n";

$reflection = new ReflectionMethod('ASimpleObject', 'methodWithMultipleParameters');
$signature = new Domain51_CodeGen_Decorator_Method_Signature($reflection);
echo $signature . "\n";

?>
===DONE===
--EXPECT--
public function methodWithParameter($parameter)
public function methodWithMultipleParameters($one, $two)
===DONE===