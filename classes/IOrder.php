<?php 
namespace App;
	interface IOrder
	{
		 public function getId();
		 public function setId($id);
		 public function getPair();
		 public function setPair($pair);
		 public function getAmount();
		 public function setAmount($amount);
		 public function getPrice();
		 public function setPrice($price);
		 public function getBtc();
		 public function setBtc($btc);
		 public function getPosition();
		 public function setPosition($position);
		 public function getTaxa();
		 public function setTaxa($taxa);
		 public function getOrder();
		 public function setOrder($order);
		 public function getStart();
		 public function setStart($start);
		 public function getIdUser();
		 public function setIdUser($id_user);
		 public function getPricePoloniex();
		 public function setPricePoloniex($price_poloniex);
		 public function getDataOpened();
		 public function setDataOpened($data_opened);
		 public function getDataClosed();
		 public function setDataClosed($data_closed);
		 public function getTypeOrder();
		 public function setTypeOrder($type);
	}

 ?>
