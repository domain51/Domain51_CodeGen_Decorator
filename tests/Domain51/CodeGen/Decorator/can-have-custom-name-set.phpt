--TEST--
By setting the name property, you can change the name of the generated class
--FILE--
<?php
// BEGIN REMOVE
set_include_path(dirname(__FILE__) . '/../../../' . PATH_SEPARATOR.
                 dirname(__FILE__) . '/../../../../src' . PATH_SEPARATOR .
                 get_include_path()
                );
// END REMOVE

require_once 'Domain51/CodeGen/Decorator.php';
require_once dirname(__FILE__) . '/_simple_objects.inc';

$decorator = new Domain51_CodeGen_Decorator('ASimpleObject');
$decorator->name = "ADecorator";
eval((string)$decorator);

assert('class_exists("ADecorator")');

?>
===DONE===
--EXPECT--
===DONE===