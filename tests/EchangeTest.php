<?php
/**
 * Created by PhpStorm.
 * User: Brixton le Brave
 * Date: 13/11/2017
 * Time: 17:08
 */

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
require '../src/Product.php';
require '../src/Echange.php';
require '../src/EmailSender.php';
require '../src/DatabaseConnection.php';

class EchangeTest extends TestCase
{
    public function testcheckValidExchange() {
        $receiver = $this->getMockBuilder('User')->disableOriginalConstructor()->getMock();
        $receiver->expects($this->exactly(1))->method('isValid')->willReturn(true);

        $deliver = $this->getMockBuilder('User')->disableOriginalConstructor()->getMock();
        $deliver->expects($this->once())->method('isValid')->willReturn(true);

        $product = $this->getMockBuilder('Product')->disableOriginalConstructor()->getMock();
        $product->expects($this->once())->method('isValid')->willReturn(true);

        $emailReceiver = $this->getMockBuilder('EmailSender')->disableOriginalConstructor()->getMock();
        $emailReceiver->method('sendEmail')->willReturn(true);


        $dbConnection = $this->getMockBuilder('DatabaseConnection')->disableOriginalConstructor()->getMock();
        $dbConnection->method('saveExchange')->willReturn(true);

        $this->assertTrue(Echange::checkValidExchange(
            new Echange($deliver, $receiver,new DateTime('now'), new DateTime('now'), $product, $emailReceiver, $dbConnection)));

    }

    public function testDoExchange() {
        $receiver = $this->getMockBuilder('User')->disableOriginalConstructor()->getMock();
        $receiver->expects($this->once())->method('isValid')->willReturn(true);
        $receiver->expects($this->once())->method('getAge')->willReturn(20);

        $deliver = $this->getMockBuilder('User')->disableOriginalConstructor()->getMock();
        $deliver->expects($this->once())->method('isValid')->willReturn(true);

        $product = $this->getMockBuilder('Product')->disableOriginalConstructor()->getMock();
        $product->expects($this->once())->method('isValid')->willReturn(true);

        $emailReceiver = $this->getMockBuilder('EmailSender')->disableOriginalConstructor()->getMock();
        $emailReceiver->method('sendEmail')->willReturn(true);


        $dbConnection = $this->getMockBuilder('DatabaseConnection')->disableOriginalConstructor()->getMock();
        $dbConnection->method('saveExchange')->willReturn(true);


        $this->assertTrue(Echange::doExchange(
            new Echange($deliver, $receiver,new DateTime('now'), new DateTime('tomorrow'), $product, $emailReceiver, $dbConnection)));
    }

    public function testDoExchangeFalseDate() {
        $receiver = $this->getMockBuilder('User')->disableOriginalConstructor()->getMock();
        $receiver->expects($this->once())->method('isValid')->willReturn(true);
        $receiver->method('getAge')->willReturn(20);

        $deliver = $this->getMockBuilder('User')->disableOriginalConstructor()->getMock();
        $deliver->expects($this->once())->method('isValid')->willReturn(true);

        $product = $this->getMockBuilder('Product')->disableOriginalConstructor()->getMock();
        $product->expects($this->once())->method('isValid')->willReturn(true);

        $emailReceiver = $this->getMockBuilder('EmailSender')->disableOriginalConstructor()->getMock();
        $emailReceiver->method('sendEmail')->willReturn(true);


        $dbConnection = $this->getMockBuilder('DatabaseConnection')->disableOriginalConstructor()->getMock();
        $dbConnection->method('saveExchange')->willReturn(true);


        $this->assertFalse(Echange::doExchange(
            new Echange($deliver, $receiver,new DateTime('tomorrow'), new DateTime('now'), $product, $emailReceiver, $dbConnection)));
    }
}
