--TEST--
Prefix increment and decrement
--FILE--
<?php

/*
   +-------------------------------------------------------------+
   | Copyright (c) 2014 Facebook, Inc. (http://www.facebook.com) |
   +-------------------------------------------------------------+
*/

error_reporting(-1);

// decrements twice before incrementing
function incdec($a)
{
	echo "--------------------------------------- start incdec ---\n";
	$b = $a;
	echo '$a = '.$a." <---> "; var_dump($a);
//	echo '$b = '.$b." <---> "; var_dump($b);

	--$a;
	echo '$a = '.$a." <---> "; var_dump($a);
	$b -= 1;
//	echo '$b = '.$b." <---> "; var_dump($b);

	--$a;
	echo '$a = '.$a." <---> "; var_dump($a);
	$b -= 1;
//	echo '$b = '.$b." <---> "; var_dump($b);

	++$a;
	echo '$a = '.$a." <---> "; var_dump($a);
	$b += 1;
//	echo '$b = '.$b." <---> "; var_dump($b);

	echo '$a = '.++$a."\n";
	echo '$a = '.$a." <---> "; var_dump($a);
	echo "--------------------------------------- end incdec ---\n";
}

// increments twice before decrementing
function incdecrev($a)
{
	echo "--------------------------------------- start incdecrev ---\n";
	$b = $a;
	echo '$a = '.$a." <---> "; var_dump($a);
//	echo '$b = '.$b." <---> "; var_dump($b);

	++$a;
	echo '$a = '.$a." <---> "; var_dump($a);
	$b += 1;
//	echo '$b = '.$b." <---> "; var_dump($b);

	++$a;
	echo '$a = '.$a." <---> "; var_dump($a);
	$b += 1;
//	echo '$b = '.$b." <---> "; var_dump($b);

	--$a;
	echo '$a = '.$a." <---> "; var_dump($a);
	$b -= 1;
//	echo '$b = '.$b." <---> "; var_dump($b);

	echo '$a = '.++$a."\n";
	echo '$a = '.$a." <---> "; var_dump($a);
	echo "--------------------------------------- end incdecrev ---\n";
}

///*
// integer values ----------------------------------------------------

incdec(5);
incdecrev(5);
incdec(-10);
incdecrev(-10);

// floating-point values ----------------------------------------------------

incdec(12.345);
incdecrev(12.345);
//*/

///*
// special IEEE floating-point values ----------------------------------------------------

incdec(INF);
incdecrev(INF);
incdec(-INF);
incdecrev(-INF);
incdec(NAN);
incdecrev(NAN);
//*/

///*
// NULL value ----------------------------------------------------

incdec(NULL);
incdecrev(NULL);
//*/

///*
// Boolean values ----------------------------------------------------

incdec(TRUE);
incdecrev(FALSE);
//*/

///*
// string values ----------------------------------------------------
// an empty string

incdec("");
incdecrev("");
//*/

// strings containing numbers
///*
// whole-numbers

incdec("0");
incdecrev("0");
incdec("9");
incdecrev("9");
incdec("26");
incdecrev("26");
incdec("98325");
incdecrev("98325");
incdec("9223372036854775807");
incdecrev("9223372036854775807");
//*/

///*
// test if number bases other than decimal are supported

incdec("012");
incdecrev("012");
incdec("0x12");
incdecrev("0x12");
incdec("0X12");
incdecrev("0X12");
incdec("0b101");
incdecrev("0b101");
incdec("0B101");
incdecrev("0B101");
incdec("0Q101");
incdecrev("0Q101");
//*/

///*
// fractional values

incdec("123.456");
incdecrev("123.456");
incdec("1.23E-27");
incdecrev("1.23E-27");
//*/

///*
// IEEE special values

//*/

///*
// leading and trailing whitespace

incdec(" 43");
incdecrev(" 43");
incdec("   654");
incdecrev("   654");
incdec("\t \n\f\r\v94");
incdecrev("\t \n\f\r\v94");
incdec("987 ");
incdecrev("987 ");
incdec("15 \t \n\f\r\v");
incdecrev("15 \t \n\f\r\v");
//*/

///*
// strings with leading zeros

incdec("012");
incdecrev("012");
incdec("   000012345");
incdecrev("   000012345");
incdec("00012.345");
incdecrev("00012.345");
incdec("  00012.345");
incdecrev("  00012.345");
//*/

///*
// leading sign

incdec("-12345");
incdecrev("-12345");
incdec("+9.87");
incdecrev("+9.87");
//*/

// string containing non-numbers
///*
// strings containing one alphabetic character

incdec("a");
incdecrev("a");
incdec("z");
incdecrev("z");

incdec("A");
incdecrev("A");
incdec("Z");
incdecrev("Z");
//*/
///*
// strings containing multiple alphanumeric characters

incdec("F28");
incdecrev("F28");
incdec("F28");
incdecrev("F98");
incdec("F98");
incdecrev("FZ8");
incdec("ZZ8");
incdecrev("ZZ8");
incdecrev("543J");
incdec("543J");
incdecrev("543J9");
incdec("543J9");
//*/

///*
// strings ending in non-alphanumeric characters

incdec("&");
incdecrev("&");
incdec("83&");
incdecrev("83&");
incdec("83&8");
incdecrev("83&8");
incdec("83&Z8");
incdecrev("83&Z8");
incdec("83&z8");
incdecrev("83&z8");
incdec("&28");
incdecrev("&28");
incdec("&98");
incdecrev("&98");
//*/

$x = "aa";
var_dump($x);
var_dump(--$x);
var_dump(--$x);

$x = "zza";
var_dump($x);
var_dump(--$x);
var_dump(--$x);
--EXPECTF--
--------------------------------------- start incdec ---
$a = 5 <---> int(5)
$a = 4 <---> int(4)
$a = 3 <---> int(3)
$a = 4 <---> int(4)
$a = 5
$a = 5 <---> int(5)
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a = 5 <---> int(5)
$a = 6 <---> int(6)
$a = 7 <---> int(7)
$a = 6 <---> int(6)
$a = 7
$a = 7 <---> int(7)
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a = -10 <---> int(-10)
$a = -11 <---> int(-11)
$a = -12 <---> int(-12)
$a = -11 <---> int(-11)
$a = -10
$a = -10 <---> int(-10)
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a = -10 <---> int(-10)
$a = -9 <---> int(-9)
$a = -8 <---> int(-8)
$a = -9 <---> int(-9)
$a = -8
$a = -8 <---> int(-8)
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a = 12.345 <---> float(12.345)
$a = 11.345 <---> float(11.345)
$a = 10.345 <---> float(10.345)
$a = 11.345 <---> float(11.345)
$a = 12.345
$a = 12.345 <---> float(12.345)
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a = 12.345 <---> float(12.345)
$a = 13.345 <---> float(13.345)
$a = 14.345 <---> float(14.345)
$a = 13.345 <---> float(13.345)
$a = 14.345
$a = 14.345 <---> float(14.345)
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a = INF <---> float(INF)
$a = INF <---> float(INF)
$a = INF <---> float(INF)
$a = INF <---> float(INF)
$a = INF
$a = INF <---> float(INF)
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a = INF <---> float(INF)
$a = INF <---> float(INF)
$a = INF <---> float(INF)
$a = INF <---> float(INF)
$a = INF
$a = INF <---> float(INF)
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a = -INF <---> float(-INF)
$a = -INF <---> float(-INF)
$a = -INF <---> float(-INF)
$a = -INF <---> float(-INF)
$a = -INF
$a = -INF <---> float(-INF)
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a = -INF <---> float(-INF)
$a = -INF <---> float(-INF)
$a = -INF <---> float(-INF)
$a = -INF <---> float(-INF)
$a = -INF
$a = -INF <---> float(-INF)
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a = NAN <---> float(NAN)
$a = NAN <---> float(NAN)
$a = NAN <---> float(NAN)
$a = NAN <---> float(NAN)
$a = NAN
$a = NAN <---> float(NAN)
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a = NAN <---> float(NAN)
$a = NAN <---> float(NAN)
$a = NAN <---> float(NAN)
$a = NAN <---> float(NAN)
$a = NAN
$a = NAN <---> float(NAN)
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a =  <---> NULL
$a =  <---> NULL
$a =  <---> NULL
$a = 1 <---> int(1)
$a = 2
$a = 2 <---> int(2)
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a =  <---> NULL
$a = 1 <---> int(1)
$a = 2 <---> int(2)
$a = 1 <---> int(1)
$a = 2
$a = 2 <---> int(2)
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a = 1 <---> bool(true)
$a = 1 <---> bool(true)
$a = 1 <---> bool(true)
$a = 1 <---> bool(true)
$a = 1
$a = 1 <---> bool(true)
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a =  <---> bool(false)
$a =  <---> bool(false)
$a =  <---> bool(false)
$a =  <---> bool(false)
$a = 
$a =  <---> bool(false)
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a =  <---> string(0) ""
$a = -1 <---> int(-1)

Warning: A non-numeric value encountered in %s on line %d
$a = -2 <---> int(-2)
$a = -1 <---> int(-1)
$a = 0
$a = 0 <---> int(0)
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a =  <---> string(0) ""
$a = 1 <---> string(1) "1"

Warning: A non-numeric value encountered in %s on line %d
$a = 2 <---> int(2)
$a = 1 <---> int(1)
$a = 2
$a = 2 <---> int(2)
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a = 0 <---> string(1) "0"
$a = -1 <---> int(-1)
$a = -2 <---> int(-2)
$a = -1 <---> int(-1)
$a = 0
$a = 0 <---> int(0)
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a = 0 <---> string(1) "0"
$a = 1 <---> int(1)
$a = 2 <---> int(2)
$a = 1 <---> int(1)
$a = 2
$a = 2 <---> int(2)
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a = 9 <---> string(1) "9"
$a = 8 <---> int(8)
$a = 7 <---> int(7)
$a = 8 <---> int(8)
$a = 9
$a = 9 <---> int(9)
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a = 9 <---> string(1) "9"
$a = 10 <---> int(10)
$a = 11 <---> int(11)
$a = 10 <---> int(10)
$a = 11
$a = 11 <---> int(11)
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a = 26 <---> string(2) "26"
$a = 25 <---> int(25)
$a = 24 <---> int(24)
$a = 25 <---> int(25)
$a = 26
$a = 26 <---> int(26)
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a = 26 <---> string(2) "26"
$a = 27 <---> int(27)
$a = 28 <---> int(28)
$a = 27 <---> int(27)
$a = 28
$a = 28 <---> int(28)
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a = 98325 <---> string(5) "98325"
$a = 98324 <---> int(98324)
$a = 98323 <---> int(98323)
$a = 98324 <---> int(98324)
$a = 98325
$a = 98325 <---> int(98325)
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a = 98325 <---> string(5) "98325"
$a = 98326 <---> int(98326)
$a = 98327 <---> int(98327)
$a = 98326 <---> int(98326)
$a = 98327
$a = 98327 <---> int(98327)
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a = 9223372036854775807 <---> string(19) "9223372036854775807"
$a = 9223372036854775806 <---> int(9223372036854775806)
$a = 9223372036854775805 <---> int(9223372036854775805)
$a = 9223372036854775806 <---> int(9223372036854775806)
$a = 9223372036854775807
$a = 9223372036854775807 <---> int(9223372036854775807)
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a = 9223372036854775807 <---> string(19) "9223372036854775807"
$a = 9.2233720368548E+18 <---> float(9.2233720368548E+18)
$a = 9.2233720368548E+18 <---> float(9.2233720368548E+18)
$a = 9.2233720368548E+18 <---> float(9.2233720368548E+18)
$a = 9.2233720368548E+18
$a = 9.2233720368548E+18 <---> float(9.2233720368548E+18)
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a = 012 <---> string(3) "012"
$a = 11 <---> int(11)
$a = 10 <---> int(10)
$a = 11 <---> int(11)
$a = 12
$a = 12 <---> int(12)
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a = 012 <---> string(3) "012"
$a = 13 <---> int(13)
$a = 14 <---> int(14)
$a = 13 <---> int(13)
$a = 14
$a = 14 <---> int(14)
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a = 0x12 <---> string(4) "0x12"
$a = 0x12 <---> string(4) "0x12"

Notice: A non well formed numeric value encountered in %s on line %d
$a = 0x12 <---> string(4) "0x12"
$a = 0x13 <---> string(4) "0x13"
$a = 0x14
$a = 0x14 <---> string(4) "0x14"
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a = 0x12 <---> string(4) "0x12"
$a = 0x13 <---> string(4) "0x13"

Notice: A non well formed numeric value encountered in %s on line %d
$a = 0x14 <---> string(4) "0x14"
$a = 0x14 <---> string(4) "0x14"
$a = 0x15
$a = 0x15 <---> string(4) "0x15"
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a = 0X12 <---> string(4) "0X12"
$a = 0X12 <---> string(4) "0X12"

Notice: A non well formed numeric value encountered in %s on line %d
$a = 0X12 <---> string(4) "0X12"
$a = 0X13 <---> string(4) "0X13"
$a = 0X14
$a = 0X14 <---> string(4) "0X14"
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a = 0X12 <---> string(4) "0X12"
$a = 0X13 <---> string(4) "0X13"

Notice: A non well formed numeric value encountered in %s on line %d
$a = 0X14 <---> string(4) "0X14"
$a = 0X14 <---> string(4) "0X14"
$a = 0X15
$a = 0X15 <---> string(4) "0X15"
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a = 0b101 <---> string(5) "0b101"
$a = 0b101 <---> string(5) "0b101"

Notice: A non well formed numeric value encountered in %s on line %d
$a = 0b101 <---> string(5) "0b101"
$a = 0b102 <---> string(5) "0b102"
$a = 0b103
$a = 0b103 <---> string(5) "0b103"
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a = 0b101 <---> string(5) "0b101"
$a = 0b102 <---> string(5) "0b102"

Notice: A non well formed numeric value encountered in %s on line %d
$a = 0b103 <---> string(5) "0b103"
$a = 0b103 <---> string(5) "0b103"
$a = 0b104
$a = 0b104 <---> string(5) "0b104"
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a = 0B101 <---> string(5) "0B101"
$a = 0B101 <---> string(5) "0B101"

Notice: A non well formed numeric value encountered in %s on line %d
$a = 0B101 <---> string(5) "0B101"
$a = 0B102 <---> string(5) "0B102"
$a = 0B103
$a = 0B103 <---> string(5) "0B103"
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a = 0B101 <---> string(5) "0B101"
$a = 0B102 <---> string(5) "0B102"

Notice: A non well formed numeric value encountered in %s on line %d
$a = 0B103 <---> string(5) "0B103"
$a = 0B103 <---> string(5) "0B103"
$a = 0B104
$a = 0B104 <---> string(5) "0B104"
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a = 0Q101 <---> string(5) "0Q101"
$a = 0Q101 <---> string(5) "0Q101"

Notice: A non well formed numeric value encountered in %s on line %d
$a = 0Q101 <---> string(5) "0Q101"
$a = 0Q102 <---> string(5) "0Q102"
$a = 0Q103
$a = 0Q103 <---> string(5) "0Q103"
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a = 0Q101 <---> string(5) "0Q101"
$a = 0Q102 <---> string(5) "0Q102"

Notice: A non well formed numeric value encountered in %s on line %d
$a = 0Q103 <---> string(5) "0Q103"
$a = 0Q103 <---> string(5) "0Q103"
$a = 0Q104
$a = 0Q104 <---> string(5) "0Q104"
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a = 123.456 <---> string(7) "123.456"
$a = 122.456 <---> float(122.456)
$a = 121.456 <---> float(121.456)
$a = 122.456 <---> float(122.456)
$a = 123.456
$a = 123.456 <---> float(123.456)
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a = 123.456 <---> string(7) "123.456"
$a = 124.456 <---> float(124.456)
$a = 125.456 <---> float(125.456)
$a = 124.456 <---> float(124.456)
$a = 125.456
$a = 125.456 <---> float(125.456)
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a = 1.23E-27 <---> string(8) "1.23E-27"
$a = -1 <---> float(-1)
$a = -2 <---> float(-2)
$a = -1 <---> float(-1)
$a = 0
$a = 0 <---> float(0)
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a = 1.23E-27 <---> string(8) "1.23E-27"
$a = 1 <---> float(1)
$a = 2 <---> float(2)
$a = 1 <---> float(1)
$a = 2
$a = 2 <---> float(2)
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a =  43 <---> string(3) " 43"
$a = 42 <---> int(42)
$a = 41 <---> int(41)
$a = 42 <---> int(42)
$a = 43
$a = 43 <---> int(43)
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a =  43 <---> string(3) " 43"
$a = 44 <---> int(44)
$a = 45 <---> int(45)
$a = 44 <---> int(44)
$a = 45
$a = 45 <---> int(45)
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a =    654 <---> string(6) "   654"
$a = 653 <---> int(653)
$a = 652 <---> int(652)
$a = 653 <---> int(653)
$a = 654
$a = 654 <---> int(654)
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a =    654 <---> string(6) "   654"
$a = 655 <---> int(655)
$a = 656 <---> int(656)
$a = 655 <---> int(655)
$a = 656
$a = 656 <---> int(656)
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a = 	 
94 <---> string(8) "	 
94"
$a = 93 <---> int(93)
$a = 92 <---> int(92)
$a = 93 <---> int(93)
$a = 94
$a = 94 <---> int(94)
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a = 	 
94 <---> string(8) "	 
94"
$a = 95 <---> int(95)
$a = 96 <---> int(96)
$a = 95 <---> int(95)
$a = 96
$a = 96 <---> int(96)
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a = 987  <---> string(4) "987 "
$a = 987  <---> string(4) "987 "

Notice: A non well formed numeric value encountered in %s on line %d
$a = 987  <---> string(4) "987 "
$a = 987  <---> string(4) "987 "
$a = 987 
$a = 987  <---> string(4) "987 "
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a = 987  <---> string(4) "987 "
$a = 987  <---> string(4) "987 "

Notice: A non well formed numeric value encountered in %s on line %d
$a = 987  <---> string(4) "987 "
$a = 987  <---> string(4) "987 "
$a = 987 
$a = 987  <---> string(4) "987 "
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a = 15 	 
 <---> string(9) "15 	 
"
$a = 15 	 
 <---> string(9) "15 	 
"

Notice: A non well formed numeric value encountered in %s on line %d
$a = 15 	 
 <---> string(9) "15 	 
"
$a = 15 	 
 <---> string(9) "15 	 
"
$a = 15 	 

$a = 15 	 
 <---> string(9) "15 	 
"
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a = 15 	 
 <---> string(9) "15 	 
"
$a = 15 	 
 <---> string(9) "15 	 
"

Notice: A non well formed numeric value encountered in %s on line %d
$a = 15 	 
 <---> string(9) "15 	 
"
$a = 15 	 
 <---> string(9) "15 	 
"
$a = 15 	 

$a = 15 	 
 <---> string(9) "15 	 
"
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a = 012 <---> string(3) "012"
$a = 11 <---> int(11)
$a = 10 <---> int(10)
$a = 11 <---> int(11)
$a = 12
$a = 12 <---> int(12)
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a = 012 <---> string(3) "012"
$a = 13 <---> int(13)
$a = 14 <---> int(14)
$a = 13 <---> int(13)
$a = 14
$a = 14 <---> int(14)
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a =    000012345 <---> string(12) "   000012345"
$a = 12344 <---> int(12344)
$a = 12343 <---> int(12343)
$a = 12344 <---> int(12344)
$a = 12345
$a = 12345 <---> int(12345)
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a =    000012345 <---> string(12) "   000012345"
$a = 12346 <---> int(12346)
$a = 12347 <---> int(12347)
$a = 12346 <---> int(12346)
$a = 12347
$a = 12347 <---> int(12347)
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a = 00012.345 <---> string(9) "00012.345"
$a = 11.345 <---> float(11.345)
$a = 10.345 <---> float(10.345)
$a = 11.345 <---> float(11.345)
$a = 12.345
$a = 12.345 <---> float(12.345)
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a = 00012.345 <---> string(9) "00012.345"
$a = 13.345 <---> float(13.345)
$a = 14.345 <---> float(14.345)
$a = 13.345 <---> float(13.345)
$a = 14.345
$a = 14.345 <---> float(14.345)
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a =   00012.345 <---> string(11) "  00012.345"
$a = 11.345 <---> float(11.345)
$a = 10.345 <---> float(10.345)
$a = 11.345 <---> float(11.345)
$a = 12.345
$a = 12.345 <---> float(12.345)
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a =   00012.345 <---> string(11) "  00012.345"
$a = 13.345 <---> float(13.345)
$a = 14.345 <---> float(14.345)
$a = 13.345 <---> float(13.345)
$a = 14.345
$a = 14.345 <---> float(14.345)
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a = -12345 <---> string(6) "-12345"
$a = -12346 <---> int(-12346)
$a = -12347 <---> int(-12347)
$a = -12346 <---> int(-12346)
$a = -12345
$a = -12345 <---> int(-12345)
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a = -12345 <---> string(6) "-12345"
$a = -12344 <---> int(-12344)
$a = -12343 <---> int(-12343)
$a = -12344 <---> int(-12344)
$a = -12343
$a = -12343 <---> int(-12343)
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a = +9.87 <---> string(5) "+9.87"
$a = 8.87 <---> float(8.87)
$a = 7.87 <---> float(7.87)
$a = 8.87 <---> float(8.87)
$a = 9.87
$a = 9.87 <---> float(9.87)
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a = +9.87 <---> string(5) "+9.87"
$a = 10.87 <---> float(10.87)
$a = 11.87 <---> float(11.87)
$a = 10.87 <---> float(10.87)
$a = 11.87
$a = 11.87 <---> float(11.87)
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a = a <---> string(1) "a"
$a = a <---> string(1) "a"

Warning: A non-numeric value encountered in %s on line %d
$a = a <---> string(1) "a"
$a = b <---> string(1) "b"
$a = c
$a = c <---> string(1) "c"
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a = a <---> string(1) "a"
$a = b <---> string(1) "b"

Warning: A non-numeric value encountered in %s on line %d
$a = c <---> string(1) "c"
$a = c <---> string(1) "c"
$a = d
$a = d <---> string(1) "d"
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a = z <---> string(1) "z"
$a = z <---> string(1) "z"

Warning: A non-numeric value encountered in %s on line %d
$a = z <---> string(1) "z"
$a = aa <---> string(2) "aa"
$a = ab
$a = ab <---> string(2) "ab"
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a = z <---> string(1) "z"
$a = aa <---> string(2) "aa"

Warning: A non-numeric value encountered in %s on line %d
$a = ab <---> string(2) "ab"
$a = ab <---> string(2) "ab"
$a = ac
$a = ac <---> string(2) "ac"
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a = A <---> string(1) "A"
$a = A <---> string(1) "A"

Warning: A non-numeric value encountered in %s on line %d
$a = A <---> string(1) "A"
$a = B <---> string(1) "B"
$a = C
$a = C <---> string(1) "C"
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a = A <---> string(1) "A"
$a = B <---> string(1) "B"

Warning: A non-numeric value encountered in %s on line %d
$a = C <---> string(1) "C"
$a = C <---> string(1) "C"
$a = D
$a = D <---> string(1) "D"
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a = Z <---> string(1) "Z"
$a = Z <---> string(1) "Z"

Warning: A non-numeric value encountered in %s on line %d
$a = Z <---> string(1) "Z"
$a = AA <---> string(2) "AA"
$a = AB
$a = AB <---> string(2) "AB"
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a = Z <---> string(1) "Z"
$a = AA <---> string(2) "AA"

Warning: A non-numeric value encountered in %s on line %d
$a = AB <---> string(2) "AB"
$a = AB <---> string(2) "AB"
$a = AC
$a = AC <---> string(2) "AC"
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a = F28 <---> string(3) "F28"
$a = F28 <---> string(3) "F28"

Warning: A non-numeric value encountered in %s on line %d
$a = F28 <---> string(3) "F28"
$a = F29 <---> string(3) "F29"
$a = F30
$a = F30 <---> string(3) "F30"
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a = F28 <---> string(3) "F28"
$a = F29 <---> string(3) "F29"

Warning: A non-numeric value encountered in %s on line %d
$a = F30 <---> string(3) "F30"
$a = F30 <---> string(3) "F30"
$a = F31
$a = F31 <---> string(3) "F31"
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a = F28 <---> string(3) "F28"
$a = F28 <---> string(3) "F28"

Warning: A non-numeric value encountered in %s on line %d
$a = F28 <---> string(3) "F28"
$a = F29 <---> string(3) "F29"
$a = F30
$a = F30 <---> string(3) "F30"
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a = F98 <---> string(3) "F98"
$a = F99 <---> string(3) "F99"

Warning: A non-numeric value encountered in %s on line %d
$a = G00 <---> string(3) "G00"
$a = G00 <---> string(3) "G00"
$a = G01
$a = G01 <---> string(3) "G01"
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a = F98 <---> string(3) "F98"
$a = F98 <---> string(3) "F98"

Warning: A non-numeric value encountered in %s on line %d
$a = F98 <---> string(3) "F98"
$a = F99 <---> string(3) "F99"
$a = G00
$a = G00 <---> string(3) "G00"
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a = FZ8 <---> string(3) "FZ8"
$a = FZ9 <---> string(3) "FZ9"

Warning: A non-numeric value encountered in %s on line %d
$a = GA0 <---> string(3) "GA0"
$a = GA0 <---> string(3) "GA0"
$a = GA1
$a = GA1 <---> string(3) "GA1"
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a = ZZ8 <---> string(3) "ZZ8"
$a = ZZ8 <---> string(3) "ZZ8"

Warning: A non-numeric value encountered in %s on line %d
$a = ZZ8 <---> string(3) "ZZ8"
$a = ZZ9 <---> string(3) "ZZ9"
$a = AAA0
$a = AAA0 <---> string(4) "AAA0"
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a = ZZ8 <---> string(3) "ZZ8"
$a = ZZ9 <---> string(3) "ZZ9"

Warning: A non-numeric value encountered in %s on line %d
$a = AAA0 <---> string(4) "AAA0"
$a = AAA0 <---> string(4) "AAA0"
$a = AAA1
$a = AAA1 <---> string(4) "AAA1"
--------------------------------------- end incdecrev ---
--------------------------------------- start incdecrev ---
$a = 543J <---> string(4) "543J"
$a = 543K <---> string(4) "543K"

Notice: A non well formed numeric value encountered in %s on line %d
$a = 543L <---> string(4) "543L"
$a = 543L <---> string(4) "543L"
$a = 543M
$a = 543M <---> string(4) "543M"
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a = 543J <---> string(4) "543J"
$a = 543J <---> string(4) "543J"

Notice: A non well formed numeric value encountered in %s on line %d
$a = 543J <---> string(4) "543J"
$a = 543K <---> string(4) "543K"
$a = 543L
$a = 543L <---> string(4) "543L"
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a = 543J9 <---> string(5) "543J9"
$a = 543K0 <---> string(5) "543K0"

Notice: A non well formed numeric value encountered in %s on line %d
$a = 543K1 <---> string(5) "543K1"
$a = 543K1 <---> string(5) "543K1"
$a = 543K2
$a = 543K2 <---> string(5) "543K2"
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a = 543J9 <---> string(5) "543J9"
$a = 543J9 <---> string(5) "543J9"

Notice: A non well formed numeric value encountered in %s on line %d
$a = 543J9 <---> string(5) "543J9"
$a = 543K0 <---> string(5) "543K0"
$a = 543K1
$a = 543K1 <---> string(5) "543K1"
--------------------------------------- end incdec ---
--------------------------------------- start incdec ---
$a = & <---> string(1) "&"
$a = & <---> string(1) "&"

Warning: A non-numeric value encountered in %s on line %d
$a = & <---> string(1) "&"
$a = & <---> string(1) "&"
$a = &
$a = & <---> string(1) "&"
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a = & <---> string(1) "&"
$a = & <---> string(1) "&"

Warning: A non-numeric value encountered in %s on line %d
$a = & <---> string(1) "&"
$a = & <---> string(1) "&"
$a = &
$a = & <---> string(1) "&"
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a = 83& <---> string(3) "83&"
$a = 83& <---> string(3) "83&"

Notice: A non well formed numeric value encountered in %s on line %d
$a = 83& <---> string(3) "83&"
$a = 83& <---> string(3) "83&"
$a = 83&
$a = 83& <---> string(3) "83&"
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a = 83& <---> string(3) "83&"
$a = 83& <---> string(3) "83&"

Notice: A non well formed numeric value encountered in %s on line %d
$a = 83& <---> string(3) "83&"
$a = 83& <---> string(3) "83&"
$a = 83&
$a = 83& <---> string(3) "83&"
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a = 83&8 <---> string(4) "83&8"
$a = 83&8 <---> string(4) "83&8"

Notice: A non well formed numeric value encountered in %s on line %d
$a = 83&8 <---> string(4) "83&8"
$a = 83&9 <---> string(4) "83&9"
$a = 83&0
$a = 83&0 <---> string(4) "83&0"
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a = 83&8 <---> string(4) "83&8"
$a = 83&9 <---> string(4) "83&9"

Notice: A non well formed numeric value encountered in %s on line %d
$a = 83&0 <---> string(4) "83&0"
$a = 83&0 <---> string(4) "83&0"
$a = 83&1
$a = 83&1 <---> string(4) "83&1"
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a = 83&Z8 <---> string(5) "83&Z8"
$a = 83&Z8 <---> string(5) "83&Z8"

Notice: A non well formed numeric value encountered in %s on line %d
$a = 83&Z8 <---> string(5) "83&Z8"
$a = 83&Z9 <---> string(5) "83&Z9"
$a = 83&A0
$a = 83&A0 <---> string(5) "83&A0"
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a = 83&Z8 <---> string(5) "83&Z8"
$a = 83&Z9 <---> string(5) "83&Z9"

Notice: A non well formed numeric value encountered in %s on line %d
$a = 83&A0 <---> string(5) "83&A0"
$a = 83&A0 <---> string(5) "83&A0"
$a = 83&A1
$a = 83&A1 <---> string(5) "83&A1"
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a = 83&z8 <---> string(5) "83&z8"
$a = 83&z8 <---> string(5) "83&z8"

Notice: A non well formed numeric value encountered in %s on line %d
$a = 83&z8 <---> string(5) "83&z8"
$a = 83&z9 <---> string(5) "83&z9"
$a = 83&a0
$a = 83&a0 <---> string(5) "83&a0"
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a = 83&z8 <---> string(5) "83&z8"
$a = 83&z9 <---> string(5) "83&z9"

Notice: A non well formed numeric value encountered in %s on line %d
$a = 83&a0 <---> string(5) "83&a0"
$a = 83&a0 <---> string(5) "83&a0"
$a = 83&a1
$a = 83&a1 <---> string(5) "83&a1"
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a = &28 <---> string(3) "&28"
$a = &28 <---> string(3) "&28"

Warning: A non-numeric value encountered in %s on line %d
$a = &28 <---> string(3) "&28"
$a = &29 <---> string(3) "&29"
$a = &30
$a = &30 <---> string(3) "&30"
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a = &28 <---> string(3) "&28"
$a = &29 <---> string(3) "&29"

Warning: A non-numeric value encountered in %s on line %d
$a = &30 <---> string(3) "&30"
$a = &30 <---> string(3) "&30"
$a = &31
$a = &31 <---> string(3) "&31"
--------------------------------------- end incdecrev ---
--------------------------------------- start incdec ---
$a = &98 <---> string(3) "&98"
$a = &98 <---> string(3) "&98"

Warning: A non-numeric value encountered in %s on line %d
$a = &98 <---> string(3) "&98"
$a = &99 <---> string(3) "&99"
$a = &00
$a = &00 <---> string(3) "&00"
--------------------------------------- end incdec ---
--------------------------------------- start incdecrev ---
$a = &98 <---> string(3) "&98"
$a = &99 <---> string(3) "&99"

Warning: A non-numeric value encountered in %s on line %d
$a = &00 <---> string(3) "&00"
$a = &00 <---> string(3) "&00"
$a = &01
$a = &01 <---> string(3) "&01"
--------------------------------------- end incdecrev ---
string(2) "aa"
string(2) "aa"
string(2) "aa"
string(3) "zza"
string(3) "zza"
string(3) "zza"
