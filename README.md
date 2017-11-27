# Reusable interfaces for PHP objects

[![Build Status](https://travis-ci.org/simondeeley/type.svg?branch=master)](https://travis-ci.org/simondeeley/type) [![Latest Stable Version](https://poser.pugx.org/simondeeley/type/v/stable)](https://packagist.org/packages/simondeeley/type) [![Total Downloads](https://poser.pugx.org/simondeeley/type/downloads)](https://packagist.org/packages/simondeeley/type) [![Latest Unstable Version](https://poser.pugx.org/simondeeley/type/v/unstable)](https://packagist.org/packages/simondeeley/type) [![License](https://poser.pugx.org/simondeeley/type/license)](https://packagist.org/packages/simondeeley/type)

This package contains a few reusable classes, interfaces and traits which have been written to provide a basis for creating both immutable and variable objects.

This package was born out of a love creating beautifully crafted 'boilerplate' code which can be reused again and again in any number of both simple and complex objects. Most of the ideas used in this package revolve around the need to create the most basic of PHP objects - one that is immutable and unchanging. Trouble is, PHP has a fair few 'magic methods' which, although great for method overriding, are less great for ensuring an immutable state.

### The basic prototype
Everything has to start somewhere and all interfaces built using this package are extended from `Type`. It has only one method that you must implement which is `getType`. It is a static method and should return a string describing the type of the object it represents, for example:

```php
use simondeeley\Type\Type;

class Foo implements Type
{
    public static function getType(): string
    {
        return 'foo';
    }
}
```

### Extending to immutable objects
From here on in, we can start to build more complex interfaces. This package a more useful interface which is `ImmutableType`. This requires that you implement PHP's magic methods of `__set` and `__unset`. Specifically, when implementing these methods you should always thrown an exception in your code to prevent accidental setting or unsetting of your objects properties, especially if those objects are exposed to third-party API's where you might not have such fine-grained control over what methods (magic or otherwise) could be invoked on your objects.

To save you having to repeat boilerplate code, two abstract classes are provided in the form of `ImmutableObject` and `ImmutableArrayTypeObject`. The former has concrete implementations of `__set` and `__unset` which throw exceptions when invoked. `ImmutableArrayTypeObject` goes one step further and also implements `ArrayAccess`. This interface allows your objects to be accessed and handled like arrays in PHP. To enforce the immutability of its sibling, two further methods are implemented, `offsetSet` and `offsetUnset`. Likewise, they too throw exceptions letting you know that direct access to the objects properties are not allowed.

### Immutability and Equality
Oftentimes there is a need to enforce checks that two objects are equal. This package provides a `TypeEquality` interface which describes one method, `equals`. This method takes an object of type `Type` as an argument. Concrete implementations should then perform necessary checks to compare the two objects before returning true or false.

This method optionally accepts a further parameter - a bitwise integer flag. This can be used to enforce or ignore certain constraints. Currently, two flags are supported:

- TypeEquality::IGNORE_OBJECT_TYPE - Set this flag to ignore the type of the object which is set by Type::getType.
- TypeEquality::IGNORE_OBJECT_IDENTITY - Set this flag to ignore checking that an object points to the same PHP reference, for example by checking the value obtained by invoking spl_object_hash.

Bitwise operators can be combined by using the pipe '|' operator, for example `$foo->equals($bar, TypeEquality::IGNORE_OBJECT_TYPE | TypeEquality::IGNORE_OBJECT_IDENTITY)`
