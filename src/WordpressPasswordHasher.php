<?php
declare(strict_types=1);

namespace Phauthentic\PasswordHasher;

use Cake\Auth\AbstractPasswordHasher;
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
    public function hash($password)
    {
        $this->getPassWordHash()->hashPassword($password);
    }

    /**
     * Check hash. Generate hash from user provided password string or data array
     * and check against existing hash.
     *
     * @param string|array $password Plain text password to hash or data array.
     * @param string $hashedPassword Existing hashed password.
     * @return bool True if hashes match else false.
     */
    public function check($password, $hashedPassword)
    {
        return $this->getPassWordHash()->checkPassword($password, $hashedPassword);
    }
}
