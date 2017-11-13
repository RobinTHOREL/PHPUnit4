<?php
/**
 * Created by PhpStorm.
 * User: Brixton le Brave
 * Date: 13/11/2017
 * Time: 14:41
 */

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
require './src/User.php';

class UserTest extends TestCase
{

    public function testIsValid() {
        $u = new User(13, "thorelrobin@yahoo.fr", "Robin", "THOREL");

        $this->assertTrue(User::isValid($u));
    }

    public function testIsValidAge() {
        $u = new User(10, "thorelrobin@yahoo.fr", "Robin", "THOREL");

        $this->assertFalse( User::isValid($u));
    }

    public function testIsValidMail() {
        $u = new User(13, "thorelrobin@yahoo.fr", "Robin", "THOREL");

        $u->setEmail("before@after");

        $this->assertFalse(User::isValid($u));

    }

    public function testIsValidName() {
        $u = new User(13, "thorelrobin@yahoo.fr", "Robin", "THOREL");

        $u->setNom("");

        $this->assertFalse( User::isValid($u));
    }
}
