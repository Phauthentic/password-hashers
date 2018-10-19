<?php
declare(strict_types=1);
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
namespace Phauthentic\PasswordHasher;

use PasswordHash;
use RuntimeException;

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
     * Wordpress Passwordhasher
     *
     * @var \PasswordHash
     */
    protected $wpPasswordHash;

    /**
     * {@inheritDoc}
     */
    public function __construct(?PasswordHash $passwordHash = null)
    {
        $this->wpPassWordHash = $passwordHash;
    }

    /**
     * Gets the instance of the WP PasswordHash class
     *
     * @return \PasswordHash
     */
    public function getPassWordHash()
    {
        if (empty($this->wpPassWordHash)) {
            $this->wpPassWordHash = new PasswordHash(8, true);
        }

        return $this->wpPassWordHash;
    }

    /**
     * Generates password hash.
     *
     * @param string|array $password Plain text password to hash or array of data
     *   required to generate password hash.
     * @return string Password hash
     */
    public function hash(string $password): string
    {
        return $this->getPassWordHash()->hashPassword($password);
    }

    /**
     * Check hash. Generate hash from user provided password string or data array
     * and check against existing hash.
     *
     * @param string|array $password Plain text password to hash or data array.
     * @param string $hashedPassword Existing hashed password.
     * @return bool True if hashes match else false.
     */
    public function check($password, string $hashedPassword): bool
    {
        return $this->getPassWordHash()->checkPassword($password, $hashedPassword);
    }
}
