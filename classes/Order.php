<?php 



namespace App;



class Order Implements IOrder

{

	private $id;

	private $pair;

	private $amount;

	private $price;

	private $btc;

	private $position;

	private $taxa;

    private $taxa_sell;

	private $order;

	private $start;

    private $id_user;

    private $price_poloniex;

    private $data_opened;

    private $data_closed;

    private $type_order;

    private $data_start;

    private $max_orders;

    private $verify;

  

    public function getId()

    {

        return $this->id;

    }



    public function setVerify($verify)

    {

        $this->verify = $verify;

        return $this;

    }



    public function getVerify()

    {

        return $this->verify;

    }



    public function setId($id)

    {

        $this->id = $id;



        return $this;

    }





    public function getPair()

    {

        return $this->pair;

    }





    public function setPair($pair)

    {

        $this->pair = strtoupper($pair);



        return $this;

    }





    public function getAmount()

    {

        return $this->amount;

    }



    public function setAmount($amount)

    {

        $this->amount = $amount;



        return $this;

    }





    public function getPrice()

    {

        return $this->price;

    }





    public function setPrice($price)

    {

        $this->price = $price;



        return $this;

    }



    public function getBtc()

    {

        return $this->btc;

    }



    public function setBtc($btc)

    {

        $this->btc = $btc;



        return $this;

    }





    public function getPosition()

    {

        return $this->position;

    }





    public function setPosition($position)

    {

        $this->position = $position;



        return $this;

    }



    public function getTaxaSell()

    {

        return $this->taxa_sell;

    }



    public function setTaxaSell($taxa_sell)

    {

        $this->taxa_sell = $taxa_sell;



        return $this;

    }

    public function getTaxa()

    {

        return $this->taxa;

    }





    public function setTaxa($taxa)

    {

        $this->taxa = $taxa;



        return $this;

    }





    public function getOrder()

    {

        return $this->order;

    }



    public function setOrder($order)

    {

        $this->order = $order;



        return $this;

    }





    public function getStart()

    {

        return $this->start;

    }





    public function setStart($start)

    {

        $this->start = $start;



        return $this;

    }



    public function setIdUser($id_user)

    {

        $this->id_user = $id_user;

        return $this;

    }



    public function getIdUser()

    {

        return $this->id_user;

    }



    public function getPricePoloniex()

    {

        return $this->price_poloniex;

    }



    public function setPricePoloniex($price_poloniex)

    {

        $this->price_poloniex = $price_poloniex;

        return $this;

    }



    public function getDataOpened()

    {

        return $this->data_opened;

    }



    public function setDataOpened($data_opened)

    {

        $this->data_opened = $data_opened;

        return $this;

    }



    public function getDataClosed()

    {

        return $this->data_closed;

    }



    public function setDataClosed($data_closed)

    {

        $this->data_closed = $data_closed;

        return $this;

    }



    public function getTypeOrder()

    {

        return $this->type_order;

    }



    public function setTypeOrder($type)

    {

        $this->type_order = $type;

        return $this;

    }



    public function getDataStart()

    {

        return $this->data_start;

    }



    public function setDataStart($data_start)

    {

        $this->data_start = $data_start;

        return $this;

    }



    public function setMaxOrders($max_orders)

    {

        $this->max_orders = $max_orders;

        return $this;

    }



    public function getMaxOrders()

    {

        return $this->max_orders;

    }

}



 ?>