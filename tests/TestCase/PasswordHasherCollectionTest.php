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

use Phauthentic\PasswordHasher\DefaultPasswordHasher;
use Phauthentic\PasswordHasher\PasswordHasherCollection;
use PHPUnit\Framework\TestCase;

/**
 * PasswordHasherCollectionTest
 */
class PasswordHasherCollectionTest extends TestCase
{

    /**
     * testCount
     *
     * @return void
     */
    public function testCount(): void
    {
        $collection = new PasswordHasherCollection();
        $this->assertEquals(0, $collection->count());
        $this->assertFalse($collection->offsetExists(0));
    }

    /**
     * testOffsets
     *
     * @return void
     */
    public function testOffsets(): void
    {
        $hasher = new DefaultPasswordHasher();

        $collection = new PasswordHasherCollection();
        $collection->add($hasher);

        $this->assertTrue($collection->offsetExists(0));
        $this->assertSame($hasher, $collection->offsetGet(0));
    }

    /**
     * testOffsetSet
     *
     * @expectedException \RuntimeException
     */
    public function testOffsetSet(): void
    {
        $hasher = new DefaultPasswordHasher();

        $collection = new PasswordHasherCollection();
        $collection->offsetSet(0, $hasher);
    }
}
