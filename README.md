## TS_Class
PHP Class Definition with String defined named properties
### Problem and solution
* Regular OOP does not allow to access properties values by name without hard coding the name of the property (even with ArrayAccess interface in PHP).  
* There seems to be a need of a new class definition allowing to get instance properties values by name without ambiguity.  
* TS_Class tries to solve it by coding property names directly within the class definition.  
* This may facilitate server/client transfers and more generally object communications.  
* This implementation is in PHP but may be useful for other languages
```php
// Regular OOP (without accessors and mutators)
class Class1 {
    public $property1;
    public $property2;
}
// TS_Class OOP
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
$class1->set(Class1::$property1, 1);
$class1->get(Class1::$property1);
//
// Properties initialization
$class1->arraySet( array(
  Class1::$property1=>1,
  Class1::$property2=>2
));
```
### Limitation  
The syntax requires more things to write compare to regular OOP
