<?php
declare(strict_types=1);
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
namespace Phauthentic\PasswordHasher;

use Cake\Core\Configure;
use Cake\Error\Debugger;
use Cake\Utility\Security;
use RuntimeException;

/**
 * Password hashing class that use weak hashing algorithms. This class is
 * intended only to be used with legacy databases where passwords have
 * not been migrated to a stronger algorithm yet.
 */
class CakeLegacyPasswordHasher extends AbstractPasswordHasher
{

    /**
     * Hash type
     *
     * @var string
     */
    protected $hashType = 'sha1';

    /**
     * @var bool
     */
    protected $cakeIsPresent = false;

    /**
     * @var string
     */
    protected $salt;

    /**
     * {@inheritDoc}
     */
    public function __construct($useFallback = false)
    {
        if (class_exists(Security::class) && $useFallback === false) {
            $this->cakeIsPresent = true;
            if (Configure::read('debug')) {
                Debugger::checkSecurityKeys();
            }
        }
    }

    /**
     * Sets the hash type
     *
     * @param string $type Hashing algo to use. Valid values are those supported by `$algo` argument of `password_hash()`. Defaults to `PASSWORD_DEFAULT`
     * @return $this
     */
    public function setHashType(string $type): self
    {
        $this->hashType = $type;

        return $this;
    }

    /**
     * Sets the salt
     *
     * @param string $salt Salt
     * @return $this
     */
    public function setSalt(string $salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Generates password hash.
     *
     * @param string $password Plain text password to hash.
     * @return string Password hash
     */
    public function hash($password): string {
        if ($this->cakeIsPresent) {
            return Security::hash($password, $this->hashType, true);
        }

        return $this->fallbackHash($password);
    }

    /**
     * Basically a copy of Cakes Security::hash() method
     *
     * @param string $password
     * @return string
     */
    protected function fallbackHash($password)
    {
        if (empty($this->hashType)) {
            throw new RuntimeException('You must specify a hash type');
        }

        $algorithm = strtolower($this->hashType);

        $availableAlgorithms = hash_algos();
        if (!in_array($algorithm, $availableAlgorithms)) {
            throw new RuntimeException(sprintf(
                'The hash type `%s` was not found. Available algorithms are: %s',
                $algorithm,
                implode(', ', $availableAlgorithms)
            ));
        }

        if ($this->salt) {
            if (!is_string($this->salt)) {
                throw new RuntimeException('No salt present');
            }
            $string = $this->salt . $password;
        }

        return hash($algorithm, $password);
    }

    /**
     * Check hash. Generate hash for user provided password and check against existing hash.
     *
     * @param string $password Plain text password to hash.
     * @param string $hashedPassword Existing hashed password.
     * @return bool True if hashes match else false.
     */
    public function check($password, string $hashedPassword): bool
    {
        return $hashedPassword === $this->hash($password);
    }
}
