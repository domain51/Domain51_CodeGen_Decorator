--TEST--
Domain51_CodeGen_Decorator_Method_Arguments is used to generate a list of arguments for a given
method.
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
    public function noArguments() { }
    public function oneArgument($one) { }
    public function twoArguments($one, $two) { }
}

$reflection = new ReflectionMethod('ASimpleClass', 'noArguments');
echo new Domain51_CodeGen_Decorator_Method_Arguments($reflection) . "\n";

$reflection = new ReflectionMethod('ASimpleClass', 'oneArgument');
echo new Domain51_CodeGen_Decorator_Method_Arguments($reflection) . "\n";

$reflection = new ReflectionMethod('ASimpleClass', 'twoArguments');
echo new Domain51_CodeGen_Decorator_Method_Arguments($reflection) . "\n";

?>
===DONE===
--EXPECT--

$one
$one, $two
===DONE===