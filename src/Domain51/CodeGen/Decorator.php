<?php

class Domain51_CodeGen_Decorator
{
    public function __construct()
    {
        
    }
    
    public function __toString()
    {
        return "class ASimpleObjectDecorator {
            public function __construct(ASimpleObject \$decorated) { }
            public function message() { return'Hello World!'; }
            public function random() { return 'Random Number: ' . rand(100, 199); }
            }";
    }
}