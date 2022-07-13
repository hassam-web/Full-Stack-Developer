<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP</title>
</head>
<body>
    <?php
 declare (strict_types = 1); // strict requirement

 echo "WORKING";
 echo "<br>";
 print_r("WORKING"); //return 1

//Variables are case sensitive

// $color = "red";
// echo "<br> My car is " . $color . "<br>"; //red is avaibale here
// echo "<br> My car is $color <br>"; //red is avaibale here
// echo "<br> My car is {$color} <br>"; //red is avaibale here
// echo "<br> My car is " + $color + "<br>"; //red is avaibale here
// echo `<br> My car is ${$color} <br>`; //red is avaibale here

// echo "My house is " . $COLOR . "<br>"; //red is not avaibale here
// echo "My boat is " . $coLOR . "<br>"; //red is not avaibale here

// single line comment
//variables

// multi line comment
/*
asdas
asda
 */

// PHP Variables
// A variable can have a short name (like x and y) or a more descriptive name (age, carname, total_volume).

// Rules for PHP variables:

// A variable starts with the $ sign, followed by the name of the variable
// A variable name must start with a letter or the underscore character
// A variable name cannot start with a number
// A variable name can only contain alpha-numeric characters and underscores (A-z, 0-9, and _ )
// Variable names are case-sensitive ($age and $AGE are two different variables)

// $txt = "W3Schools.com";
// echo $txt . '<br /><br />';
// echo "I love $txt!";
// echo "<br />";

// $x = 5;
// $y = 4;
// echo $x + $y;

// PHP Variables Scope

// global scope
// local scope
// static scope
// { } = scope

// GLOBAL SCOPE
// A variable declared outside a function has a GLOBAL SCOPE and can only be accessed outside a function:

// $x = 5; // global scope

// function myTest()
// {
//     // using x inside this function will generate an error
//     echo "<p>Variable x inside function is: $x</p>";
// }
// echo $x;
// myTest();

// echo "<p>Variable x outside function is: $x</p>";

// local scope:

// A variable declared within a function has a LOCAL SCOPE and can only be accessed within that function:

// function myTest()
// {
//     $x = 5; // local scope
//     echo "<p>Variable x inside function is: $x</p>";
// }
// echo $x; //throw error because its local scope variable
// myTest();

// // using x outside the function will generate an error
// echo "<p>Variable x outside function is: $x</p>";

// PHP The static Keyword

// Normally, when a function is completed/executed, all of its variables are deleted. However, sometimes we want a local variable NOT to be deleted. We need it for a further job.

 function myTest()
 {
     static $x = 0;
      $x = 0;
     echo $x;
        $x++;
 }

// myTest();
// echo "<br>";
// myTest();
// echo "<br>";
// myTest();

// Global Keyword

// $x = 5;
// $y = 10;

// function myTest()
// {
//     global $x, $y;
//     $y = $x + $y;
// }

// myTest();
// echo $y; // outputs 15

// $connection = 'database connected';

// function insert_category()
// {
//     global $connection;
//     echo $connection;
//     $GLOBALS['connection'];
// }

// PHP echo and print Statements

/*
PHP Data Types
Variables can store data of different types, and different data types can do different things.
PHP supports the following data types:
String
Integer
Float (floating point numbers - also called double)
Boolean
Array
Object
NULL
Resource
 */

//  PHP String
$x = "Hello world!";
$y = 'Hello world!';
$y = 'Hello world!';
$y = 'Hello world!';
$y = 'Hello world!';
$y = 'Hello world!';
$y = 'Hello world!';
$y = 'Hello world!';


echo $x;
echo "<br>";
echo $y;
//String Functions
// echo strlen("Hello world!"); // outputs 12
// echo str_word_count("Hello world!"); // outputs 2
// echo strrev("Hello world!"); // outputs !dlrow olleH
// strpos() - Search For a Text Within a String
// echo strpos("Hello world!", "world"); // outputs 6
// echo str_replace("world", "Dolly", "Hello world!"); // outputs Hello Dolly!
// echo str_replace("world", "Dolly", "Hello world!"); // outputs Hello Dolly!

/*
PHP Integer
An integer data type is a non-decimal number between -2,147,483,648 and 2,147,483,647.
Rules for integers:
An integer must have at least one digit
An integer must not have a decimal point
An integer can be either positive or negative
Integers can be specified in: decimal (base 10), hexadecimal (base 16), octal (base 8), or binary (base 2) notation
$x = 5985;
var_dump($x);
PHP Float
A float (floating point number) is a number with a decimal point or a number in exponential form.
$x = 10.365;
var_dump($x);
PHP Boolean
A Boolean represents two possible states: TRUE or FALSE.
$x = true;
$y = false;
PHP Array
An array stores multiple values in one single variable.
$cars = array("Volvo", "BMW", "Toyota");
var_dump($cars);
echo "<br />";
echo "<pre>";
print_r($cars);
echo "</pre>";
PHP Object
class Car
{
public $color; // properties
public $model;
public function __construct($color, $model)
{
$this->color = $color;
$this->model = $model;
}
//methods
public function message()
{
return "My car is a " . $this->color . " " . $this->model . "!";
}
}
$myCar = new Car("black", "Volvo");
echo $myCar->message();
echo "<br>";
$myCar = new Car("red", "Toyota");
echo $myCar->message();
PHP NULL Value
Null is a special data type which can have only one value: NULL.
$x = "Hello world!";
$x = null;
var_dump($x);
PHP Constants
A constant is an identifier (name) for a simple value. The value cannot be changed during the script.
define(name, value, case-insensitive)
define("GREETING", "Welcome to W3Schools.com!");
echo GREETING;
 */

class Goodbye
{
    const LEAVING_MESSAGE = "Thank you for visiting W3Schools.com!";
}

echo Goodbye::LEAVING_MESSAGE;

class GoodbyeTwo
{
    const LEAVING_MESSAGE = "Thank you for visiting W3Schools.com!";
    public function byebye()
    {
        echo self::LEAVING_MESSAGE;
        // echo $this::LEAVING_MESSAGE;
    }
}

$goodbye = new GoodbyeTwo();
$goodbye->byebye();

// PHP Math

/*
echo(pi()); // returns 3.1415926535898
echo (min(0, 150, 30, 20, -8, -200)); // returns -200
echo (max(0, 150, 30, 20, -8, -200)); // returns 150
echo (abs(-6.7)); // returns 6.7
echo (sqrt(64)); // returns 8
echo (round(0.60)); // returns 1
echo (round(0.49)); // returns 0
echo (rand());
echo (rand(10, 100));
 */

function writeMsg()
{
    echo "Hello world!";
}

writeMsg(); // call the function

function familyName($fname)
{
    echo "$fname Refsnes.<br>";
}

familyName("Jani");
familyName("Hege");
familyName("Stale");
familyName("Kai Jim");
familyName("Borge");

// function familyName($fname, $year)
// {
//     echo "$fname Refsnes. Born in $year <br>";
// }

// familyName("Hege", "1975");
// familyName("Stale", "1978");
// familyName("Kai Jim", "1983");

function addNumbers(int $a, int $b)
{
    return $a + $b;
}
// echo addNumbers(5, array("5 days", "222"));
echo addNumbers(5, 4);

//default argument
function setHeight(int $minheight = 50)
{
    echo "The height is : $minheight <br>";
}

setHeight(350);
setHeight();
setHeight(135);
setHeight(80);
// since strict is NOT enabled "5 days" is changed to int(5), and it will return 10

//returning values

function sum(int $x, int $y)
{
    $z = $x + $y;
    return $z;
}

echo "5 + 10 = " . sum(5, 10) . "<br>";
echo "7 + 13 = " . sum(7, 13) . "<br>";
echo "2 + 4 = " . sum(2, 4);

// Passing Arguments by Reference

function add_five(&$value)
{
    $value += 5;
}

$num = 2;
add_five($num);
echo $num;

// PHP Indexed Arrays

// $cars = array("Volvo", "BMW", "Toyota");
/*
$cars[0] = "Volvo";
$cars[1] = "BMW";
$cars[2] = "Toyota";
$age = array("Peter" => "35", "Ben" => "37", "Joe" => "43");
$age['Peter'] = "35";
$age['Ben'] = "37";
$age['Joe'] = "43";
 */

echo "<pre>";
print_r($_GET);
echo "</pre>";
?>
</body>
</html>