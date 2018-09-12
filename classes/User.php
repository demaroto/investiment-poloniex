<?php 

namespace App;

class User
{
    private $id;	private $user;
	private $pass;
    private $key;
    private $secret;
    private $saldo;
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }


    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }


    public function getPass()
    {
        return $this->pass;
    }


    public function setPass($pass)
    {
        $this->pass = md5($pass);

        return $this;
    }

    public function setPassIndex($pass)
    {
        $this->pass = $pass;

        return $this;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    public function getSecret()
    {
        return $this->secret;
    }

    public function setSecret($secret)
    {
        $this->secret = $secret;
        return $this;
    }

    public function getSaldo()
    {
        return $this->saldo;
    }

    public function setSaldo($saldo)
    {
        $this->saldo = $saldo;
        return $this;
    }


}

 ?>