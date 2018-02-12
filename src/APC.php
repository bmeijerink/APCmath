<?php

namespace APCmath;

/**
 * Class APC
 * 
 * Class APC (Arbitrary Precision Calculations) provides methods to perform calculations with 
 * arbitrary-precision numbers. The numbers can be passed as integer, float or string, 
 * in normal floating point notation or in scientific format.
 * 
 * Provided methods:
 * 
 * APC::scale($scale); sets the default scale parameter for all APCmath (and bc math) functions
 * APC::add($leftOperand, $rightOperand, $scale = null); adds two arbitrary precision numbers
 * APC::sub($leftOperand, $rightOperand, $scale = null); subtracts one arbitrary precision number from another
 * APC::mul($leftOperand, $rightOperand, $scale = null); multiplies two arbitrary precision numbers
 * APC::div($dividend, $divisor, $scale = null); divides two arbitrary precision numbers
 * APC::mod($dividend, $modulus); calculates the modulus of an arbitrary precision number division
 * APC::comp($leftOperand, $rightOperand, $scale = null); comp compares two arbitrary precision numbers
 * APC::pow($base, $exponent, $scale = null); raises an arbitrary precision number to another
 * APC::powMod($base, $power, $modulo, $scale = null); raises an arbitrary precision number to another, reduced by a specified modulus
 * APC::sqrt ($val, $scale = null); 
 *
 * @package APCmath
 * 
 */

class APC
{
    /**
     * @var integer scale value
     */
    protected static $scale = null;
    
    /**
     * scale sets the default scale parameter for all APCmath math functions (and bc math)
     *
     * @param integer $scale the number of digits after the decimal place in the result
     * @return bool
     */
    public static function scale($scale)
    {
        if ($retval = bcscale($scale)) {
            static::$scale = $scale;
        }
        return $retval;
    }

    /**
     * Add adds two arbitrary precision numbers
     *
     * @param string|integer|float $leftOperand left operand
     * @param string|integer|float $rightOperand right operand
     * @param integer $scale [optional] the number of digits after the decimal place in the result, default scale if ommitted 
     * @return string The sum of the two operands, as a string
     */
    public static function add($leftOperand, $rightOperand, $scale = null)
    {
        $scale = static::getScale($scale);
        return bcadd(static::toString($leftOperand), static::toString($rightOperand), $scale);
    }

    /**
     * sub subtracts one arbitrary precision number from another (subtracts the right operand from the left operand)
     *
     * @param string|integer|float $leftOperand left operand
     * @param string|integer|float $rightOperand right operand
     * @param integer $scale [optional]  the number of digits after the decimal place in the result, default scale if ommitted
     * @return string the result of the subtraction, as a string
     */
    public static function sub($leftOperand, $rightOperand, $scale = null)
    {
        $scale = static::getScale($scale);
        return bcsub(static::toString($leftOperand), static::toString($rightOperand), $scale);
    }
    
    /**
     * mul multiplies two arbitrary precision numbers
     *
     * @param string|integer|float $leftOperand left operand
     * @param string|integer|float $rightOperand righ operand
     * @param integer $scale [optional] the number of digits after the decimal place in the result, default scale if ommitted
     * @return string the result as a string
     */
    public static function mul($leftOperand, $rightOperand, $scale = null)
    {
        $scale = static::getScale($scale);
        return bcmul(static::toString($leftOperand), static::toString($rightOperand), $scale);
    }
    
    /**
     * div divides two arbitrary precision numbers
     *
     * @param string|integer|float $dividend dividend
     * @param string|integer|float $divisor divisor
     * @param integer $scale [optional] the number of digits after the decimal place in the result, default scale if ommitted
     * @return string the result of the division as a string, or null if divisor is 0
     */
    public static function div($dividend, $divisor, $scale = null)
    {
        $scale = static::getScale($scale);
        return bcdiv(static::toString($dividend), static::toString($divisor), $scale);
    }
    
    /**
     * mod calculates the modulus of an arbitrary precision number division
     *
     * @param string|integer|float $dividend dividend
     * @param string|integer|float $modulus modulus
     * @return string the modulus as a string, or null if modulus is 0
     */
    public static function mod($dividend, $modulus)
    {
        return bcmod(intval($dividend, 0), intval($modulus, 0));
    }
    
    /**
     * comp compares two arbitrary precision numbers
     *
     * @param string|integer|float $leftOperand left operand
     * @param string|integer|float $rightOperand right operand
     * @param integer $scale [optional] the number of digits after the decimal place in the result, default scale if ommitted
     * @return integer 0 if the two operands are equal, 1 if the $leftOperand is larger than the $rightOperand, -1 otherwise
     */
    public static function comp($leftOperand, $rightOperand, $scale = null)
    {
        $scale = static::getScale($scale);
        return bccomp(static::toString($leftOperand), static::toString($rightOperand), $scale);
    }
    
    /**
     * pow raises an arbitrary precision number to another
     *
     * @param string|integer|float $base base
     * @param string|integer|float $exponent exponent
     * @param integer $scale [optional] the number of digits after the decimal place in the result, default scale if ommitted
     * @return string the result as a string
     */
    public static function pow($base, $exponent, $scale = null)
    {
        $scale = static::getScale($scale);
        return bcpow(static::toString($base), static::toString($exponent), $scale);
    }
    
    /**
     * powMod raises an arbitrary precision number to another, reduced by a specified modulus
     *
     * @param string|integer|float $base base
     * @param string|integer|float $power power
     * @param string|integer|float $modulo modulo
     * @param integer $scale [optional]  the number of digits after the decimal place in the result, default scale if ommitted
     * @return string the result as a string, or null if modulus is 0 or exponent is negative
     */
    public static function powMod($base, $power, $modulo, $scale = null)
    {
        $scale = static::getScale($scale);
        return bcpowmod(static::toString($base), static::toString($power), $modulo, $scale);
    }
    
    /**
     * Get the square root of an arbitrary precision number
     *
     * @param string|integer|float $val
     * @param integer|null $scale
     * @return string|integer|float
     */
    public static function sqrt($val, $scale = null)
    {
        $scale = static::getScale($scale);
        return bcsqrt(static::toString($val), $scale);
    }

   // Internal
    /**
     * getScale determines the scale value, using the one passed, or falling back to the internal one if null was passed
     *
     * @param integer|null $scale scale value
     * @return integer scale value
     */
    protected static function getScale($scale)
    {
        if (is_null(static::$scale)) {
            static::$scale = intval(ini_get('bcmath.scale'));
        }
        if (is_null($scale)) {
            $scale = static::$scale;
        }
        return intval($scale);
    }
    
    /**
     * toString converts a number in scientific format, integer or float to a non-scientific
     * formatted string
     *  
     * @param string|integer|float $number number to convert
     * @return string converted number
     */
    protected static function toString($number) 
    {
        if (is_string($number) or is_float($number)) {
            return sprintf('%F', $number);
        }
        elseif (is_int($number)) {
            return sprintf('%d', $number);
        }
        return $number;
    }
}