<?php

/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

declare(strict_types=1);

namespace Phauthentic\PasswordHasher;

use InvalidArgumentException;

/**
 * Abstract password hashing class
 */
abstract class AbstractPasswordHasher implements PasswordHasherInterface
{
    public const SALT_BEFORE = 'before';
    public const SALT_AFTER = 'after';

    /**
     * Salt
     *
     * @return void
     */
    protected $salt = '';

    /**
     * Position of the salt
     *
     * @var string
     */
    protected $saltPosition;

    /**
     * Sets the salt if any was used
     *
     * @return $this
     */
    public function setSalt(string $salt, string $position = self::SALT_AFTER): self
    {
        $this->checkSaltPositionArgument($position);
        $this->salt = $salt;
        $this->saltPosition = $position;

        return $this;
    }

    /**
     * Checks the salt position argument
     *
     * @return void
     */
    protected function checkSaltPositionArgument($position): void
    {
        if (!in_array($position, [self::SALT_BEFORE, self::SALT_AFTER])) {
            throw new InvalidArgumentException(sprintf(
                '`%s` is an invalud argument, it has to be `` or ``',
                $position,
                self::SALT_BEFORE,
                self::SALT_AFTER
            ));
        }
    }

    /**
     * Adds the salt to a password
     *
     * @param string $password Password to salt
     * @return string Salted password
     */
    protected function saltPassword(string $password): string
    {
        if (empty($this->salt)) {
            return $password;
        }

        if ($this->saltPosition === self::SALT_BEFORE) {
            return $this->salt . $password;
        }

        return $password . $this->salt;
    }

    /**
     * Returns true if the password need to be rehashed, due to the password being
     * created with anything else than the passwords generated by this class.
     *
     * Returns true by default since the only implementation users should rely
     * on is the one provided by default in php 5.5+ or any compatible library
     *
     * @param string $password The password to verify
     * @return bool
     */
    public function needsRehash(string $password): bool
    {
        return password_needs_rehash($password, PASSWORD_DEFAULT);
    }
}
