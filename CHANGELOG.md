1.2.2
=====
* Use scrutinizer-ci for reporting metrics

1.2.1
=====
* Update test suites to PHP 7.2 and include code coverage report

1.2.0
=====
* Added [`ImmutableMethodCallException`](../blob/master/src/Exceptions/ImmutableMethodCallException.php)
* Improve exception handling by throwing [`ImmutableMethodCallException`](../blob/master/src/Exceptions/ImmutableMethodCallException.php) when trying to change an immutable objects properties.

1.1.0
=====
* Added bitwise flags to `TypeEquality::equals` method
* Add new helper trait which provides two new methods that take leverage the bitwise flags in `TypeEquality::equals` to create short-cut checks

1.0.0
=====
Initial release
