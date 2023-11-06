<?php

namespace Ashraful\TestProject;

use InvalidArgumentException;

class Calculator
{
    public function add($a, $b)
    {
        return $a + $b;
    }

    public function substract($a, $b)
    {
        return $a - $b;
    }

    public function multifly($a, $b)
    {
        return $a * $b;
    }
    
    public function divide($a, $b)
    {
        if ($b == 0) {
            throw new \InvalidArgumentException("Cannot divide by zero");
        }
        return $a / $b;
    }

}