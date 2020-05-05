<?php

/**
 * Copyright (c) Phauthentic (https://github.com/Phauthentic)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Phauthentic (https://github.com/Phauthentic)
 * @link          https://github.com/Phauthentic
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

declare(strict_types=1);

namespace Phauthentic\PasswordHasher;

/**
 * Sha1 Password Hasher
 *
 * WARNING: This is UNSAFE and should NOT be used anymore!!! sha1 has been
 * compromised! It is no longer a secure hash algorythm!
 *
 * This hasher just exists for legacy reasons and is thought to be used with
 * the Fallback hasher, to update the passwords transparently to a secure hash.
 *
 * @link http://php.net/manual/en/function.sha1.php
 */
class Sha1PasswordHasher extends Md5PasswordHasher
{
    /**
     * Calls the actual php method that will do the hashing
     *
     * @link http://php.net/manual/en/function.sha1.php
     * @param string $password Password string
     * @return string
     */
    protected function callHashFunction(string $password): string
    {
        return sha1($password, $this->rawOutput);
    }
}
