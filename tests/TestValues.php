<?php
require_once __DIR__ ."/../helpers.php";

/**
 * Class Test
 */
class Test extends PHPUnit_Framework_TestCase
{
    public function testFloats()
    {
        $this->assertTrue(isFloat(1.3));
        $this->assertTrue(isFloat(1.01));
    }

    public function testIntegers()
    {
        $this->assertTrue(isInt(34));
        $this->assertTrue(isInt(900123400));
    }

    public function testStringsAsIntegers()
    {
        $this->assertTrue(isInt("34"));
        $this->assertTrue(isInt("3432"));
        $this->assertTrue(isInt("2"));
    }

    public function testStringsAsFloats()
    {
        $this->assertTrue(isFloat("453.34"));
        $this->assertTrue(isFloat("1.3234"));
        $this->assertTrue(isFloat("65.34e3"));
    }

    public function testRandomStringsAreNotIntegersOrFloats()
    {
        $strings = [
            "34reihudj",
            "23,2382398",
            "203928934jkds.92389jd",
            "zero",
            "0924a",
            "ppo994h ",
            "foo",
            "bar",
            "jake toolson",
            "00000000111.0000LLL",
            "0.049mm iuf"
        ];

        foreach ($strings as $string) {
            $this->assertFalse(isInt($string));
            $this->assertFalse(isFloat($string));
        }
    }
}