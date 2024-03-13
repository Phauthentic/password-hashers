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

use Phauthentic\PasswordHasher\Md5PasswordHasher;
use PHPUnit\Framework\TestCase;

/**
 * Test case for Md5
 */
class Md5PasswordHasherTest extends TestCase
{
    /**
     * Tests that only the first hasher is user for hashing a password
     *
     * @return void
     */
    public function testHash(): void
    {
        $hasher = new Md5PasswordHasher();

        $expected = '5f4dcc3b5aa765d61d8327deb882cf99';
        $result = $hasher->hash('password');
        $this->assertEquals($expected, $result);

        $hasher->setSalt('salt');
        $expected = 'b305cadbb3bce54f3aa59c64fec00dea';
        $result = $hasher->hash('password');
        $this->assertEquals($expected, $result);

        $hasher->setSalt('salt', Md5PasswordHasher::SALT_BEFORE);
        $expected = '67a1e09bb1f83f5007dc119c14d663aa';
        $result = $hasher->hash('password');
        $this->assertEquals($expected, $result);
    }

    /**
     * testInvalidSaltPosition
     *
     * @return void
     */
    public function testInvalidSaltPosition(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $hasher = new Md5PasswordHasher();
        $hasher->setSalt('salt', 'INVALID!!!');
    }

    /**
     * testCheck
     *
     * @return void
     */
    public function testCheck(): void
    {
        $hasher = new Md5PasswordHasher();

        $hash = '5f4dcc3b5aa765d61d8327deb882cf99';
        $result = $hasher->check('password', $hash);
        $this->assertTrue($result);

        $hash = 'WRONG';
        $result = $hasher->check('password', $hash);
        $this->assertFalse($result);
    }
}
