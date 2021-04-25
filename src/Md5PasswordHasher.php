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
 * Md5 Password Hasher
 *
 * WARNING: This is UNSAFE and should NOT be used anymore!!! md5 has been
 * compromised! It is no longer a secure hash algorithm!
 *
 * This hasher just exists for legacy reasons and is thought to be used with
 * the Fallback hasher, to update the passwords transparently to a secure hash.
 */
class Md5PasswordHasher extends AbstractPasswordHasher
{
    /**
     * Raw sha1 output
     *
     * @var bool
     */
    protected bool $rawOutput = false;

    /**
     * Sets the raw output mode of sha1
     *
     * @link http://php.net/manual/en/function.sha1.php
     * @param bool $rawOutput Raw output
     * @return $this
     */
    public function setRawOutput(bool $rawOutput): self
    {
        $this->rawOutput = $rawOutput;

        return $this;
    }

    /**
     * Generates password hash.
     *
     * @param string $password Plain text password to hash required to generate
     * password hash.
     * @return string Password hash
     */
    public function hash(string $password): string
    {
        $password = $this->saltPassword($password);

        return $this->callHashFunction($password);
    }

    /**
     * Calls the actual php method that will do the hashing
     *
     * @param string $password Password string
     * @return string
     */
    protected function callHashFunction(string $password): string
    {
        return md5($password, $this->rawOutput);
    }

    /**
     * Check hash. Generate hash from user provided password string
     * and check against existing hash.
     *
     * @param string $password Plain text password to hash.
     * @param string $hashedPassword Existing hashed password.
     * @return bool True if hashes match else false.
     */
    public function check(string $password, string $hashedPassword): bool
    {
        return $this->hash($password) === $hashedPassword;
    }
}
