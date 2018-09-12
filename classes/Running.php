<?php 



namespace App;



class Running

{

	private $id;
	private $key;
    private $secret;
    private $valorBid;
    private $valorAsk;
    private $pair;
    private $tipo;
    private $taxa;
    private $status;



  

    public function getId(){

        return $this->id;

    }



    public function setId($id){

        $this->id = $id;
        return $this;

    }

    public function getKey(){
        return $this->key;
    }

    public function setKey($key){
        $this->key = $key;
        return $this;
    }



    public function setSecret($secret){
           $this->secret = $secret;
        return $this;
    }

     public function getSecret(){
        return $this->secret;
    }

    public function setBid($valorBid){
        $this->valorBid = $valorBid;
        return $this;
    }

    public function getBid(){
        return $this->valorBid;
    }

    public function setAsk($valorAsk){
        $this->valorAsk = $valorAsk;
        return $this;
    }

    public function getAsk(){
        return $this->valorAsk;
    }

    public function setOrderBook($pair){
        $this->pair = $pair;
        return $this;
    }

    public function getOrderBook(){
        return $this->pair;
    }

    public function setTipo($tipo){
        $this->tipo = $tipo;
        return $this;
    }

    public function getTipo(){
        return $this->tipo;
    }

    public function setTaxa($taxa){
        $this->taxa = $taxa;
        return $this;
    }

    public function getTaxa(){
        return $this->taxa;
    }

    public function setStatus($status){
        $this->status = $status;
        return $this;
    }

    public function getStatus(){
        return $this->status;
    }

   
}



 ?>