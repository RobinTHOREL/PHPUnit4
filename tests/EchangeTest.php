<?php
/**
 * Created by PhpStorm.
 * User: Brixton le Brave
 * Date: 13/11/2017
 * Time: 17:08
 */

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
require './src/Product.php';
require './src/Echange.php';
require './src/EmailSender.php';
require './src/DatabaseConnection.php';

class EchangeTest extends TestCase
{
    public function testcheckValidExchange() {
        $receiver = $this->createMock(User::class);
        $receiver->method('isValid')
            ->willReturn(true);

        $deliver = $this->createMock(User::class);
        $deliver->method('isValid')
            ->willReturn(true);

        $product = $this->createMock(Product::class);
        $product->method('isValid')
            ->willReturn(true);

        $this->assertTrue(Echange::checkValidExchange(new Echange($deliver, $receiver, new DateTime('now'), new DateTime('now'),
            $product)));

    }
}
