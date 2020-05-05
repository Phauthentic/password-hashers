# Salting Passwords

A [salt](1) describeds an additional input that gets added to the password. The following excerpt is taken from [the Wikipedia article about salts](1).

> In cryptography, a salt is random data that is used as an additional input to a one-way function that hashes data, a password or passphrase. Salts are used to safeguard passwords in storage. Historically a password was stored in plaintext on a system, but over time additional safeguards developed to protect a user's password against being read from the system. A salt is one of those methods.

[1]: https://en.wikipedia.org/wiki/Salt_(cryptography)

Most hashers allow you to call `setSalt($salt, $beforeOrAfter)`. The first arg is the actual salt, the second `before` or `after` to add the salt before or after the actual password. When set back to an empty string `''` salting is turned off.

Example:

```php
$hasher->setSalt('mysecretsalt', 'after');
```
