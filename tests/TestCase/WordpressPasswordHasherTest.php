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

namespace Authentication\Test\TestCase\PasswordHasher;

use PasswordHash;
use Phauthentic\PasswordHasher\WordpressPasswordHasher;
use PHPUnit\Framework\TestCase;

/**
 * Test case for the Wordpress Password Hasher
 */
class WordpressPasswordHasherTest extends TestCase
{
    /**
     * @inheritDoc
     */
    public function setUp(): void
    {
        parent::setUp();

        if (!class_exists('\PasswordHash')) {
            $this->markTestSkipped('\PasswordHash class does not exist');
        }
    }

    /**
     * Tests that only the first hasher is user for hashing a password
     *
     * @return void
     */
    public function testHash()
    {
        $hasher = new WordpressPasswordHasher(new \PasswordHash(8, false));
        $hashedPassword = $hasher->hash('password');
        $this->assertTrue($hasher->check('password', $hashedPassword));
    }
}
