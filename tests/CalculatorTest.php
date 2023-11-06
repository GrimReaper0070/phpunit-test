<?php

namespace Ashraful\TestProject\Tests;

use PHPUnit\Framework\TestCase;
use Ashraful\TestProject\Calculator;
use InvalidArgumentException;

class CalculatorTest extends TestCase
{
    private $calculator;

    protected function setUp(): void
    {
        $this->calculator = new Calculator();
    }

    public function testAdd()
    {
        $result = $this->calculator->add(2, 3);
        $this->assertEquals(5, $result);
    }

    public function testSubstract()
    {
        $result = $this->calculator->substract(5, 3);
        $this->assertEquals(2, $result);
    }

    public function testMultifly()
    {
        $result = $this->calculator->multifly(2, 3);
        $this->assertEquals(6, $result);
    }

    public function testDivide()
    {
        $result = $this->calculator->divide(6, 2);
        $this->assertEquals(3, $result);
    }

    public function testDivideByZero()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Cannot divide by zero");
        $this->calculator->divide(6, 0);
    }
}
