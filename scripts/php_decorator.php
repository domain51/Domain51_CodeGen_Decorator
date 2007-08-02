#!/usr/local/bin/php
<?php

// BEGIN PACKAGE STRIP
set_include_path(dirname(__FILE__) . '/../src' . PATH_SEPARATOR . get_include_path());
// END PACKAGE STRIP

require_once 'Domain51/CodeGen/Decorator.php';
require_once 'Console/Getargs.php';

$arg_config = array(
    'class' => array(
        'short' => 'c',
        'min' => null,
        'max' => 1,
        'desc' => 'Name of class to load - must be present in the include_path using PEAR naming ' .
                  'if "file" is not specified.',
    ),
    'file' => array(
        'short' => 'f',
        'min' => null,
        'max' => 1,
        'desc' => 'File to load class file',
    ),
    'output' => array(
        'short' => 'o',
        'min' => null,
        'max' => 1,
        'desc' => 'File to output results to',
    ),
    'help' => array(
        'short' => 'h',
        'min' => null,
        'max' => null,
        'desc' => 'Display this help',
    ),
);

$options = Console_GetArgs::factory($arg_config, $argv);

if (in_array('--help', $argv) || in_array('-h', $argv)) {
    echo Console_GetArgs::getHelp($arg_config);
    exit;
}

if (PEAR::isError($options)) {
    echo "There was an error: {$options->getMessage()}\n";
    echo Console_GetArgs::getHelp($arg_config);
    exit(1);
}

if ($options->getValue('file')) {
    $file = $options->getValue('file');
} elseif ($options->getValue('class')) {
    $file = str_replace('_', '/', $options->getValue('class'));
} else {
    echo "The option file or class must be set.\n";
    exit(1);
}
require_once $file . '.php';

echo "Decorating {$options->getValue('class')}...\n";
$decorator = new Domain51_CodeGen_Decorator($options->getValue('class'));

if ($options->getValue('output')) {
    $contents = "<?php\n\n";
    $contents .= (string)$decorator;
    file_put_contents($options->getValue('output'), $contents);
} else {
    echo $decorator . "\n";
}