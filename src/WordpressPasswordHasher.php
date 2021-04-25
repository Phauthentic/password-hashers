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

use PasswordHash;

/**
 * Wordpress Password Hasher
 *
 * The wordpress password hasher is an adapter for the `\PasswordHash` class
 * which is part of Wordpress. You can copy the file class-phpass.php to your
 * project, rename the namespace or do whatever is needed to make it available
 * in your project and / or namespace.
 *
 * @link https://github.com/WordPress/WordPress/blob/master/wp-includes/class-phpass.php
 */
class WordpressPasswordHasher extends AbstractPasswordHasher
{
    /**
     * @var \PasswordHash
     */
    protected PasswordHash $wpPassWordHash;

    /**
     * {@inheritDoc}
     */
    public function __construct(PasswordHash $passwordHash)
    {
        $this->wpPassWordHash = $passwordHash;
    }

    /**
     * Gets the instance of the WP PasswordHash class
     *
     * @return \PasswordHash
     */
    public function getPassWordHash(): PasswordHash
    {
        return $this->wpPassWordHash;
    }

    /**
     * {@inheritDoc}
     */
    public function hash($password): string
    {
        return $this->getPassWordHash()->hashPassword($password);
    }

    /**
     * {@inheritDoc}
     */
    public function check(string $password, string $hashedPassword): bool
    {
        return $this->getPassWordHash()->checkPassword($password, $hashedPassword);
    }
}
