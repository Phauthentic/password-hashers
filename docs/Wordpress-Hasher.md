# Wordpress Hasher

The wordpress password hasher is an adapter for the `\PasswordHash` class which is part of Wordpress. You can [find it here](https://github.com/WordPress/WordPress/blob/master/wp-includes/class-phpass.php). The reason it is not included in this repository is the unclear license.

Copy the file to your project, rename the namespace or do whatever is needed to make it availabl in your project and / or namespace.

Then simply pass an instance of it to the WordpressPasswordHasher().

```php
use \PasswordHash
use \PasswordHasher\WordpressPasswordHasher;

$hasher = new WordpressPasswordHasher(new (PasswordHash(8, true)));
```
