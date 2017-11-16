<?php
/**
 * Created by PhpStorm.
 * User: Brixton le Brave
 * Date: 13/11/2017
 * Time: 15:29
 */

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
require './src/Product.php';

class ProductTest extends TestCase
{
    public function testIsValid() {
        $u = new User(13, "thorelrobin@yahoo.fr", "Robin", "THOREL");
        $p = new Product("Butter", $u);

        $this->assertTrue(Product::isValid($p));
    }

    public function testNomUser() {
        $u = new User(13, "thorelrobin@yahoo.fr", "Robin", "THOREL");
        $p = new Product("Butter", $u);

        $u->setNom("");

        $this->assertFalse(Product::isValid($p));
    }

    public function testNomProduct() {
        $u = new User(13, "thorelrobin@yahoo.fr", "Robin", "THOREL");
        $p = new Product("Butter", $u);

        $p->setNom("");

        $this->assertFalse(Product::isValid($p));
    }
}
