# Fallback Password Hasher

A password hasher that can use multiple different hashes where only one is the preferred one. This is useful when trying to migrate an existing database of users from one password type to another.

Because php does not yet support typed arrays we use a collection to pass a list of hashers to the fallback hasher.

**The first hasher in the list** will be used to create hash. So pass the hasher you want to use for hashing as first in the list.

```php
use \PasswordHasher\FallbackPasswordHasher;
use \PasswordHasher\Md5PasswordHasher;
use \PasswordHasher\PasswordHasherCollection;

$collection = new PasswordhasherCollection([
    new DefaultPasswordHasher(),
    new Md5PasswordHasher(),
]);

$hasher = new FallbackPasswordHasher($collection);
```

## Attention to salts

When you use the salting functionality with this hasher, it will pass the salted password to *every* hasher in the collection!

So either use the same salt for all and use the salting with this hasher or configure the salt individually for each hasher in the collection.
