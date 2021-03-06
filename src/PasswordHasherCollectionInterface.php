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

use ArrayAccess;
use IteratorAggregate;

/**
 * Password hashing class that use weak hashing algorithms. This class is
 * intended only to be used with legacy databases where passwords have
 * not been migrated to a stronger algorithm yet.
 */
interface PasswordHasherCollectionInterface extends IteratorAggregate, ArrayAccess
{
    /**
     * Adds a password hasher to the collection
     *
     * @param \Phauthentic\PasswordHasher\PasswordHasherInterface $hasher Hasher
     * @return void
     */
    public function add(PasswordHasherInterface $hasher): void;

    /**
     * Returns the count of password hashers in the collection
     *
     * @return integer
     */
    public function count(): int;
}
