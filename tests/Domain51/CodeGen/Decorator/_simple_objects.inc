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


class ASimplePropertyTracker
{
    public $sets = array();
    public $gets = array();
    
    public function __set($key, $value)
    {
        if (empty($this->sets[$key])) {
            $this->sets[$key] = 0;
        }
        
        $this->sets[$key]++;
    }
    
    public function __get($key)
    {
        if (empty($this->gets[$key])) {
            $this->gets[$key] = 0;
        }
        
        $this->gets[$key]++;
    }
}