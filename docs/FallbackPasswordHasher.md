# Fallback Password Hasher

A password hasher that can use multiple different hashes where only one is the preferred one. This is useful when trying to migrate an existing database of users from one password type to another.

Because php does not support typed arrays we use a collection to pass a list of hashers to the fallback hasher.
```php
use \PasswordHasher\FallbackPasswordHasher;
use \PasswordHasher\PasswordHasherCollection;

$collection = new PasswordhasherCollection([
    new DefaultPasswordHasher(),
    new DefaultPasswordHasher(),
]);

$hasher = new FallbackPasswordHasher($collection);
```
