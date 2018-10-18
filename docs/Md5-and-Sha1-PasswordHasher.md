# Md5 and Sha1 Password Hasher

**Warning:** Both hashers  exist only for legacy reasons! **Don't** use them for new projects! 

See [the official php password hashing FAQ](http://php.net/manual/de/faq.passwords.php#faq.passwords.fasthash).

You should only use them together with the [FallbackPasswordHasher](FallbackPasswordHasher.md) so you can migrate you old **insecure** hashes to a new hash algorithm.

```php
$hasher = new Md5PasswordHasher();
$hasher->setSalt('some-salt');

$hash = $hasher->hash('password');
$check = $hasher->check('password', 'hashedpasswordvalue');
```
