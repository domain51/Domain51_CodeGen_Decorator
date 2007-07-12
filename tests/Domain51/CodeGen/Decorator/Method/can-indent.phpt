--TEST--
If the "indention" property is set, whatever it is set will be inserted at the begining of each line
that Domain51_CodeGen_Decorator_Method creates
--FILE--
<?php
// BEGIN REMOVE
set_include_path(dirname(__FILE__) . '/../../../../' . PATH_SEPARATOR.
                 dirname(__FILE__) . '/../../../../../src' . PATH_SEPARATOR .
                 get_include_path()
                );
// END REMOVE

require_once 'Domain51/CodeGen/Decorator/Method.php';

class ASimpleClass
{
    public function simpleMethod() { }
}

$reflection = new ReflectionMethod('ASimpleClass', 'simpleMethod');
$method = new Domain51_CodeGen_Decorator_Method($reflection);
$method->indention = "ABCD";
echo $method . "\n";

?>
===DONE===
--EXPECT--
ABCDpublic function simpleMethod()
ABCD{
ABCD    return $this->_decorated->simpleMethod();
ABCD}
===DONE===