--TEST--
If Domain51_CodeGen_Decorator::$use_call is set to true, then only a __call() method will be
generated which handles passing all calls off to the decorated object.
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

$generator = new Domain51_CodeGen_Decorator(new ASimpleObject());
$generator->use_call = true;

eval($generator);

$reflection = new ReflectionClass('ASimpleObjectDecorator');
assert('$reflection->hasMethod("__call")');
assert('!$reflection->hasMethod("message")');

$decorator = new ASimpleObjectDecorator(new ASimpleObject());
echo $decorator->message() . "\n";


?>
===DONE===
--EXPECT--
Hello World!
===DONE===