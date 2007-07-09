<?php

class ASimpleObject
{
    public function message()
    {
        return "Hello World!";
    }
    
    public function random()
    {
        return "Random Number: " . rand(100, 199);
    }
}
