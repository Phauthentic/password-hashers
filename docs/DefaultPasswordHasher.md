# Default Password Hasher

This is an OOP abstraction of the php [password_hash()](http://php.net/manual/en/function.password-hash.php) function, that should be used to hash passwords.

The following algorithms are currently supported (list taken from php.net):

* **PASSWORD_DEFAULT** - Use the bcrypt algorithm (default as of PHP 5.5.0). Note that this constant is designed to change over time as new and stronger algorithms are added to PHP. For that reason, the length of the result from using this identifier can change over time. Therefore, it is recommended to store the result in a database column that can expand beyond 60 characters (255 characters would be a good choice).
* **PASSWORD_BCRYPT** - Use the CRYPT_BLOWFISH algorithm to create the hash. This will produce a standard crypt() compatible hash using the "$2y$" identifier. The result will always be a 60 character string, or FALSE on failure.
* **PASSWORD_ARGON2I** - Use the Argon2i hashing algorithm to create the hash. This algorithm is only available if PHP has been compiled with Argon2i support.

**Caution**: Using the PASSWORD_BCRYPT as the algorithm, will result in the password parameter being truncated to a maximum length of 72 characters.

```php
use PasswordHasher\DefaultPasswordHasher;

$hasher = (new DefaultPasswordHasher())
    ->setHashType(PASSWORD_ARGON2I);
```
