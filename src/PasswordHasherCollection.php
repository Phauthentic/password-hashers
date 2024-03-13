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

use ArrayIterator;
use RuntimeException;
use Traversable;

/**
 * Password hashing class that use weak hashing algorithms. This class is
 * intended only to be used with legacy databases where passwords have
 * not been migrated to a stronger algorithm yet.
 */
class PasswordHasherCollection implements PasswordHasherCollectionInterface
{
    /**
     * List of Hashers
     *
     * @var array<\Phauthentic\PasswordHasher\PasswordHasherInterface>
     */
    protected array $hashers = [];

    /**
     * Constructor
     *
     * @param iterable<\Phauthentic\PasswordHasher\PasswordHasherInterface> $hashers An iterable of password hashers
     */
    public function __construct(iterable $hashers = [])
    {
        foreach ($hashers as $hasher) {
            $this->add($hasher);
        }
    }

    /**
     * Adds a password hasher to the collection
     *
     * @param \Phauthentic\PasswordHasher\PasswordHasherInterface $hasher Hasher
     * @return void
     */
    public function add(PasswordHasherInterface $hasher): void
    {
        $this->hashers[] = $hasher;
    }

    /**
     * Retrieve an external iterator
     *
     * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable<\Phauthentic\PasswordHasher\PasswordHasherInterface> An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->hashers);
    }

    /**
     * Whether a offset exists
     *
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return bool true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     */
    public function offsetExists($offset): bool
    {
        return isset($this->hashers[$offset]);
    }

    /**
     * Offset to retrieve
     *
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     */
    public function offsetGet($offset): mixed
    {
        if (isset($this->hashers[$offset])) {
            return $this->hashers[$offset];
        }

        return null;
    }

    /**
     * Offset to set
     *
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     */
    public function offsetSet($offset, $value): void
    {
        throw new RuntimeException('Use add()');
    }

    /**
     * Offset to unset
     *
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     */
    public function offsetUnset($offset): void
    {
        unset($this->hashers[$offset]);
    }

    /**
     * @inheritDoc
     */
    public function count(): int
    {
        return count($this->hashers);
    }
}
