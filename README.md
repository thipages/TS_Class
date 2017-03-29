## TS_Class
PHP Class Definition with defined named properties
### Problem to solve
Define a class allowwing to get instance properties values by name without ambiguity, avoiding property name hard coding  
This may facilitate server/client transfers and more generally object communications  
```php
// Regular OOP (without accessors and mutators)
class Class1 {
    public $property1;
    public $property2;
}
// OOP with TS_Class
class Class1 extends TS_Class {
    public static $property1="property1";
    public static $property2="property2";
}
```
### Usage
```php
class Class1 extends TS_Class {
    public static $property1="property1";
    public static $property2="property2";
}
//
$class1=new Class1();
// Property initialization
$class1->set(TS_Class1::$property1, 1);
$class1->get(TS_Class1::$property1);
//
// Properties initialization
$class1->arraySet( array(
  Class1::$property1=>1,
  Class1::$property2=>2
));
```
### Limitation  
The syntax requires more things to write compare to regular OOP
