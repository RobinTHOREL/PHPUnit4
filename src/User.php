<?php
/**
 * Created by PhpStorm.
 * User: Brixton le Brave
 * Date: 13/11/2017
 * Time: 14:34
 */

declare(strict_types=1);

class User
{
    private $age;
    private $email;
    private $prenom;
    private $nom;

    public function __construct ($age, $email, $prenom, $nom) {
        $this->age = $age;
        $this->email = $email;
        $this->prenom = $prenom;
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function isValid(User $u){
        $isValid = false;

        if(filter_var($u->getEmail(), FILTER_VALIDATE_EMAIL))
            if($u->getAge() >= 13 && is_int($u->getAge()))
                if(!empty($u->getNom()) && !empty($u->getPrenom()))
                    $isValid = true;

        return $isValid;
    }
}