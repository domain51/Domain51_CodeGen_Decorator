--TEST--
The Decorator created by Domain51_CodeGen_Decorator requires the decorated object as the parameter
of its constructor.
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
eval((string)$decorator);

$reflection = new ReflectionClass('ASimpleObjectDecorator');
assert('$reflection->hasMethod("__construct")');

$constructor = $reflection->getConstructor();
$params = $constructor->getParameters();

assert('count($params) == 1');

$param = array_shift($params);
assert('!$param->isOptional()');
assert('$param->getClass()->getName() == "ASimpleObject"');

?>
===DONE===
--EXPECT--
===DONE===