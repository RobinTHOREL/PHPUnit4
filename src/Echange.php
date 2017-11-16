<?php
/**
 * Created by PhpStorm.
 * User: Brixton le Brave
 * Date: 13/11/2017
 * Time: 16:35
 */

declare(strict_types=1);

class Echange
{
    private $deliver;
    private $receiver;
    private $dateStart;
    private $dateEnd;
    private $product;
    private $emailSender;
    private $dbConnection;

    public function __construct(User $deliver, User $receiver, DateTime $dateStart, DateTime $dateEnd, Product $product, EmailSender $emailSender,
                            DatabaseConnection $dbConnect)
    {
        $this->deliver = $deliver;
        $this->receiver = $receiver;
        $this->dateStart = $dateStart;
        $this->dateEnd = $dateEnd;
        $this->product = $product;
        $this->emailSender = $emailSender;
        $this->dbConnection =  $dbConnect;
    }

    /**
     * @return User
     */
    public function getDeliver(): User
    {
        return $this->deliver;
    }

    /**
     * @param User $deliver
     */
    public function setDeliver(User $deliver)
    {
        $this->deliver = $deliver;
    }

    /**
     * @return User
     */
    public function getReceiver(): User
    {
        return $this->receiver;
    }

    /**
     * @param User $receiver
     */
    public function setReceiver(User $receiver)
    {
        $this->receiver = $receiver;
    }

    /**
     * @return DateTime
     */
    public function getDateStart(): DateTime
    {
        return $this->dateStart;
    }

    /**
     * @param DateTime $dateStart
     */
    public function setDateStart(DateTime $dateStart)
    {
        $this->dateStart = $dateStart;
    }

    /**
     * @return DateTime
     */
    public function getDateEnd(): DateTime
    {
        return $this->dateEnd;
    }

    /**
     * @param DateTime $dateEnd
     */
    public function setDateEnd(DateTime $dateEnd)
    {
        $this->dateEnd = $dateEnd;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     */
    public function setProduct(Product $product)
    {
        $this->product = $product;
    }

    public static function checkValidExchange(Echange $e) {
        $isValid = false;

        if ($e->getReceiver()->isValid($e->receiver))
            if ($e->getDeliver()->isValid($e->deliver))
                if ($e->getProduct()->isValid($e->product))
                    $isValid = true;


        return $isValid;
    }

    public function doExchange(Echange $e) {
        if($e->checkValidExchange($e)) {
            if($e->dateStart > $e->dateEnd || $e->dateStart < new DateTime("now") ) return false;
            if($e->getReceiver()->getAge() < 18) {
                $e->emailSender->sendEmail($e->getReceiver(), "Vous êtes mineur");
                $e->dbConnection->saveExchange($e);
                return true;
            } else {
                $e->dbConnection->saveExchange($e);
                return true;
            }
        }
    }
}