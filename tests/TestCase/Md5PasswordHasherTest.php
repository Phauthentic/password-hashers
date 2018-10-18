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
    public function testHash()
    {
        $hasher = new Md5PasswordHasher();

        $expected = '5f4dcc3b5aa765d61d8327deb882cf99';
        $result = $hasher->hash('password');
        $this->assertEquals($expected, $result);
    }
}
