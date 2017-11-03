<?php

trait Immutability
{
    public function __set($arg, $value)
    {
        thrown new BadMethodCall;
    }
    
    public function __get($arg)
    {
        if (isset($this->$arg)) {
           return $this->$arg;
        }
        
        throw new InvalidArgumentException;
    }
    
    public function __unset($arg)
    {
        throw new BadMethodCall;
    }
}
