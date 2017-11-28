Reusable interfaces for PHP objects
===================================

[![Build Status](https://travis-ci.org/simondeeley/type.svg?branch=master)](https://travis-ci.org/simondeeley/type) [![Latest Stable Version](https://poser.pugx.org/simondeeley/type/v/stable)](https://packagist.org/packages/simondeeley/type) [![Total Downloads](https://poser.pugx.org/simondeeley/type/downloads)](https://packagist.org/packages/simondeeley/type) [![Latest Unstable Version](https://poser.pugx.org/simondeeley/type/v/unstable)](https://packagist.org/packages/simondeeley/type) [![License](https://poser.pugx.org/simondeeley/type/license)](https://packagist.org/packages/simondeeley/type)

This package contains a few reusable classes, interfaces and traits which have been written to provide a basis for creating both immutable and variable objects.

This package was born out of a love creating beautifully crafted 'boilerplate' code which can be reused again and again in any number of both simple and complex objects. Most of the ideas used in this package revolve around the need to create the most basic of PHP objects - one that is immutable and unchanging. Trouble is, PHP has a fair few 'magic methods' which, although great for method overriding, are less great for ensuring an immutable state. This package aims to solve that problem and provide a number of base classes to allow you to build easy-to-use immutable classes of your own.

Requirements
============

* PHP >= 7.1.0

Installation
============

```
    composer require simondeeley/type
```

Usage
=====

Create your own immutable object

```php
use simondeeley\ImmutableObject;

class Foo extends ImmutableObject
{
    //...
}
```

This is the starting point to creating an immutable object. Behind the scenes, the base class of `ImmutableObject` sets up a few sensible defaults including overriding PHP's magic methods `__set` and `__unset` to prevent implicitly setting (or unsetting) of class properties.

There is one further method that you need to implement in your concrete classes which is `getType`. This method is inherited from the interface `simondeeley\Type\Type` which defines one static method (getType) which should return a string describing the type of the object.

It might seem strange having this method but it's useful when defining a bunch of objects which might, for example, share the same base class but who's identity you want to differentiate.

In the example above, you might implement the interface as such:

```php
public static function getType(): string
{
    return 'foo';
}
```

Going Further
=============

As well as `ImmutableObject` this package also provides a second base class for objects which need to behave like arrays, implementing PHP's built-in `ArrayAccess`. This behaviour is provided in `ImmutableArrayTypeObject` which extends `ImmutableObject` and includes default implementations of `offsetSet` and `offsetUnset`.

Each of these classes uses a few traits which provide the default implementations described above. You can explore these as well as the interfaces in the code which is fully documented and annotated.

Testing Equality
================

Oftentimes there is a need to check that two objects are equal. This package provides a `TypeEquality` interface which describes one method, `equals`.

```php
public bool equals ( Type $type [, int $flags ] )
```

This method takes an object of type `simondeeley\Type\Type` as an argument. This interface is the base interface that all other 'types' are built on. This method also optionally accepts a further parameter - a bitwise integer flag. This can be used to enforce or ignore certain constraints. Currently, two flags are supported:

- `TypeEquality::IGNORE_OBJECT_TYPE`
...Set this flag to ignore the type of the object which is set by `Type::getType`.

- `TypeEquality::IGNORE_OBJECT_IDENTITY`
...Set this flag to ignore checking that an object points to the same PHP reference, for example by checking the value obtained by invoking `spl_object_hash`.

Bitwise operators can be combined by using the pipe '|' operator, for example `$foo->equals($bar, TypeEquality::IGNORE_OBJECT_TYPE | TypeEquality::IGNORE_OBJECT_IDENTITY)`

When implementing this method you can choose whether to utilise the bitwise flags but they should be present in your method signature. The body of the method should then perform whatever actions are necessary to compare the two objects to determine equality. An example of this can be found in the [simondeeley\Tuple](https://github.com/simondeeley/tuple) package which uses this package to build an immutable tuple object that can check equality against another tuple.
