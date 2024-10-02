<?php


class Benutzer
{

    private $email;
    private $password;
    private $fehler = [];


    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }


    public static function get($email, $password)
    {
        if ($email == 'testi@test.at' && $password == '12345') {
            $user = new Benutzer($email, $password);
            return $user;
        } else {
            return null;
        }
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setEmail($email)
    {
        if (strlen($email) >= 5 && strlen($email) <= 30) {
            $this->email = $email;
        } else {
            $this->fehler['email'] = 'Email muss zwichen 5 und 30 Zeichen lang sein!';
        }
    }

    public function setPassword($password)
    {

        if (strlen($password) >= 5 && strlen($password) <= 20) {
            $this->password = $password;
        } else {
            $this->fehler['password'] = 'Passwort muss zwichen 5 und 20 Zeichen lang sein!';
        }
    }


    public function login()
    {
        //return boolean;
        if ($this->getEmail() == 'testi@test.at' && $this->getPassword() == '12345') {
            $_SESSION['loggedin'] = 'true';
            return true;
        } else {
            $_SESSION['loggedin'] = 'false';
            return false;
        }
    }

    public static function logout()
    {
        unset($_SESSION["loggedin"]);
    }


    public static function isLoggedIn()
    {
        //return boolean
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 'true') {
            return true;
        } else {
            return false;
        }
    }


    public function getFehler(){
       return $this->fehler;
    }

}
