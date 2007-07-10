--TEST--
Domain51_CodeGen_Decorator takes a class, and creates another class that acts as a simple decorator
around it.
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

$object = new ASimpleObjectDecorator(new ASimpleObject);
echo $object->message() . "\n";
echo $object->random() . "\n";

$reflection = new ReflectionObject($object);
assert('$reflection->hasMethod("methodWithArgument")');

?>
===DONE===
--EXPECTF--
Hello World!
Random Number: %d
===DONE===