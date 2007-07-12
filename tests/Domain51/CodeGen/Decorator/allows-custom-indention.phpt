--TEST--
By specifying the "indention" property, you can add a custom indention to the file.  Note that
the indention property will also be set on all methods that are decorated.
--FILE--
<?php
// BEGIN REMOVE
set_include_path(dirname(__FILE__) . '/../../../' . PATH_SEPARATOR.
                 dirname(__FILE__) . '/../../../../src' . PATH_SEPARATOR .
                 get_include_path()
                );
// END REMOVE

require_once 'Domain51/CodeGen/Decorator.php';

class ASimpleClass
{
    public function someMethod() { }
}

$decorator = new Domain51_CodeGen_Decorator('ASimpleClass');
$decorator->indention = "ABCD";

$code = (string)$decorator;
$code_lines = explode("\n", $code);
foreach ($code_lines as $line_num => $line) {
    assert('preg_match("/^ABCD.*/", $line)');
}

?>
===DONE===
--EXPECT--
===DONE===