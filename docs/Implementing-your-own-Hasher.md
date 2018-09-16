# Implementing your own Hasher

To implement your own hasher it must implement the interface `\PasswordHasher\PasswordHasherInterface`.

```php
use PasswordHasher\PasswordHasherInterface;

class MyAweSomeHasher implements PasswordHasherInterface
{
    public function hash($password): string;

    public function check($password, string $hashedPassword): bool;

    public function needsRehash(string $password): bool;
}
```

You'll have to implement these three methods required by the interface.
