# Password Hashers

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Scrutinizer Coverage](https://img.shields.io/scrutinizer/coverage/g/Phauthentic/password-hashers/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/Phauthentic/password-hashers/)
[![Code Quality](https://img.shields.io/scrutinizer/g/Phauthentic/password-hashers/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/Phauthentic/password-hashers/)
![phpstan Level 8](https://img.shields.io/badge/phpstan-Level%208-brightgreen?style=flat-square)
![php ^8.0](https://img.shields.io/badge/php-%5E8.0-blue?style=flat-square)

A simple password hasher library.

This is mostly an abstraction around password hashers to have an OOP interface to work with.

## Installation

Installation via [Composer](https://getcomposer.org/)

```sh
composer require Phauthentic/password-hashers
```

## Documentation

* [Default Password Hasher](./docs/DefaultPasswordHasher.md) features all algorithms [phps password_hash()](http://php.net/manual/de/function.password-hash.php) features.
* [Fallback Password Hasher](./docs/FallbackPasswordHasher.md) transparently upgrade hashes to new hash algorithms
* [Md5 & Sha1 Password Hasher](./docs/Md5-and-Sha1-PasswordHasher.md) deprecated hasing algorithms for legacy apps
* [Implementing your own Hasher](./docs/Implementing-your-own-Hasher.md)

## Copyright & License

Licensed under the [MIT license](LICENSE.txt).

* Copyright (c) [Phauthentic](https://github.com/Phauthentic)
* Copyright (c) [Cake Software Foundation, Inc.](https://cakefoundation.org)
