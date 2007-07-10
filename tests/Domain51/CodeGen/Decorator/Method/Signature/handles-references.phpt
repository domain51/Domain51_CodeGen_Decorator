--TEST--
Can handle references in the parameters
--FILE--
<?php
// BEGIN REMOVE
set_include_path(dirname(__FILE__) . '/../../../../../' . PATH_SEPARATOR.
                 dirname(__FILE__) . '/../../../../../../src' . PATH_SEPARATOR .
                 get_include_path()
                );
// END REMOVE

require_once 'Domain51/CodeGen/Decorator/Method/Signature.php';

class ASimpleClass {
    public function methodWithReferences(&$ref) { }
}

$reflection = new ReflectionMethod('ASimpleClass', 'methodWithReferences');
$signature = new Domain51_CodeGen_Decorator_Method_Signature($reflection);
echo $signature . "\n";
?>
===DONE===
--EXPECT--
public function methodWithReferences(&$ref)
===DONE===