APCmath library
====

PHP library component for arbitrary precision calculations.

Class APC
 
Class APC (Arbitrary Precision Calculations) provides methods to perform calculations with 
arbitrary-precision numbers. The numbers can be passed as integer, float or string, 
in normal floating point notation or in scientific format.
 
Provided methods:

- APC::scale($scale); sets the default scale parameter for all APCmath (and bc math) functions

- APC::add($leftOperand, $rightOperand, $scale = null); adds two arbitrary precision numbers

- APC::sub($leftOperand, $rightOperand, $scale = null); subtracts one arbitrary precision number from another

- APC::mul($leftOperand, $rightOperand, $scale = null); multiplies two arbitrary precision numbers

- APC::div($dividend, $divisor, $scale = null); divides two arbitrary precision numbers

- APC::mod($dividend, $modulus); calculates the modulus of an arbitrary precision number division

- APC::comp($leftOperand, $rightOperand, $scale = null); comp compares two arbitrary precision numbers

- APC::pow($base, $exponent, $scale = null); raises an arbitrary precision number to another

- APC::powMod($base, $power, $modulo, $scale = null); raises an arbitrary precision number to another, reduced by a specified modulus

- APC::sqrt ($val, $scale = null); 


## Installation ##

```shell
composer require bmeijerink/apcmath
```

