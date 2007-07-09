--TEST--
The Decorator uses also passes all property requests to the decorated object
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

// sanity check
$obj = new ASimplePropertyTracker();
assert('$obj->sets == array()');
assert('$obj->gets == array()');

$obj->foo = 'bar';
assert('$obj->sets == array("foo" => 1)');

$bar = $obj->foo;
assert('$obj->gets = array("foo" => 1)');
unset($bar);
unset($obj);
// end sanity check

eval(new Domain51_CodeGen_Decorator('ASimplePropertyTracker'));
$decorator = new ASimplePropertyTrackerDecorator(new ASimplePropertyTracker());

assert('$decorator->sets == array()');
assert('$decorator->gets == array()');

$decorator->foo = 'bar';
assert('$decorator->sets == array("foo" => 1)');

$foo = $decorator->foo;
assert('$decorator->gets = array("foo" => 1)');


?>
===DONE===
--EXPECT--
===DONE===