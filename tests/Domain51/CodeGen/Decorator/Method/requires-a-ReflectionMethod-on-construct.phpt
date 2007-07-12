--TEST--
Domain51_CodeGen_Decorator_Method requires a ReflectionMethod object at instantiation
--FILE--
<?php
// BEGIN REMOVE
set_include_path(dirname(__FILE__) . '/../../../../' . PATH_SEPARATOR.
                 dirname(__FILE__) . '/../../../../../src' . PATH_SEPARATOR .
                 get_include_path()
                );
// END REMOVE

require_once 'Domain51/CodeGen/Decorator/Method.php';
$reflection = new ReflectionClass('Domain51_CodeGen_Decorator_Method');
assert('$reflection->hasMethod("__construct")');

$constructor = $reflection->getConstructor();
$parameters = $constructor->getParameters();
assert('count($parameters) == 1');

$parameter = array_shift($parameters);
assert('$parameter->getClass()->getName() == "ReflectionMethod"');

?>
===DONE===
--EXPECT--
===DONE===