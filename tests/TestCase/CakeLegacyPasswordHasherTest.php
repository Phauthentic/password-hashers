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

namespace Authentication\Test\TestCase\PasswordHasher;

use Phauthentic\PasswordHasher\CakeLegacyPasswordHasher;
use PHPUnit\Framework\TestCase;
use Cake\Utility\Security;

/**
 * Test case for LegacyPasswordHasher
 */
class CakeLegacyPasswordHasherTest extends TestCase
{

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        Security::setSalt('YJfIxfs2guVoUubWDYhG93b0qyJfIxfs2guwvniR2G0FgaC9mi');
    }

    /**
     * testFallbackCode
     *
     * @return void
     */
    public function testFallbackCode(): void
    {
        $hasher = new CakeLegacyPasswordHasher(true);
        $hasher->setSalt('YJfIxfs2guVoUubWDYhG93b0qyJfIxfs2guwvniR2G0FgaC9mi');

        $password = $hasher->hash('foo');

        $this->assertTrue($hasher->check('foo', $password));
        $this->assertFalse($hasher->check('bar', $password));
    }

    /**
     * Tests that any password not produced by LegacyPasswordHasher needs
     * to be rehashed
     *
     * @return void
     */
    public function testNeedsRehash(): void
    {
        $hasher = new CakeLegacyPasswordHasher();
        $this->assertTrue($hasher->needsRehash(md5('foo')));
        $this->assertTrue($hasher->needsRehash('bar'));
        $this->assertFalse($hasher->needsRehash('$2y$10$juOA0XVFpvZa0KTxRxEYVuX5kIS7U1fKDRcxyYhhUQECN1oHYnBMy'));
    }

    /**
     * Tests hash() and check()
     *
     * @return void
     */
    public function testHashAndCheck(): void
    {
        $hasher = new CakeLegacyPasswordHasher();
        $hasher->setHashType('md5');
        $password = $hasher->hash('foo');
        $this->assertTrue($hasher->check('foo', $password));
        $this->assertFalse($hasher->check('bar', $password));

        $hasher->setHashType('sha1');
        $this->assertFalse($hasher->check('foo', $password));
    }
}
