<?php

/*
* This file is a part of GraphQL project.
*
* @author Jamie Hall <hello@jamiehall.eu>
* created: 30/11/16 14:14 PM
*/

namespace Youshido\GraphQL\Execution;

class ArgumentBag implements \IteratorAggregate, \ArrayAccess, \Countable
{
    private $arguments = [];

    public function add(array $arguments = array())
    {
        $this->arguments = array_replace($this->arguments, $arguments);
    }

    public function get($key, $default = null)
    {
        return array_key_exists($key, $this->arguments) ? $this->arguments[$key] : $default;
    }

    public function has($key)
    {
        return array_key_exists($key, $this->arguments);
    }

    public function set($key, $value)
    {
        $this->arguments[$key] = $value;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->arguments);
    }

    public function count()
    {
        return count($this->arguments);
    }
    
    public function offsetExists($offset)
    {
        return isset($this->arguments[$offset]);
    }
    
    public function offsetGet($offset)
    {
        return $this->offsetExists($offset) ? $this->arguments[$offset] : null;
    }
    
    public function offsetSet($offset, $value)
    {
        return $this->arguments[$argument] = $value;
    }
    
    public function offsetUnset($offset)
    {
        unset($this->attributes[$offset]);
    }
}
