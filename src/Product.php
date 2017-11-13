<?php
/**
 * Created by PhpStorm.
 * User: Brixton le Brave
 * Date: 13/11/2017
 * Time: 15:23
 */

declare(strict_types=1);
require 'User.php';

class Product
{
    private $nom;
    private $owner;

    public function __construct(String $nom, User $u)
    {
        $this->nom = $nom;
        $this->owner = $u;
    }

    /**
     * @return String
     */
    public function getNom(): String
    {
        return $this->nom;
    }

    /**
     * @param String $nom
     */
    public function setNom(String $nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return User
     */
    public function getOwner(): User
    {
        return $this->owner;
    }

    /**
     * @param User $owner
     */
    public function setOwner(User $owner)
    {
        $this->owner = $owner;
    }

    public static function isValid(Product $p) {
        $isValid = false;

        if(!empty($p->getNom()))
            if($p->owner->isValid($p->owner) )
                    $isValid = true;

        return $isValid;
    }
}