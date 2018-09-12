<?php 
require_once 'poloniex.php';
$key = isset($_GET['key']) ? $_GET['key'] : null;
$secret = isset($_GET['secret']) ? $_GET['secret'] : null;
$pair = isset($_GET['moeda']) ? $_GET['moeda'] : null;
//$key = "CZ85X45Y-BU66F9DV-0XKVPITX-I01HQYKS";
//$secret = "35232d3f0b4fc42ee1fe647ab6fa217b7051cabfaa79b849c591eb01608fa8154a4ebe59e04dfe3b328d51f6be1986aa27a15708af613db6581d89872598376f";
//$pair = "BTC_DIEM";

$ticker = new poloniex($key, $secret);
$preco = $ticker->get_ticker($pair)['last'];
$valorRecebido = number_format($preco, 8, '.', '');
$quebra = explode('.', $valorRecebido);
$valorQuebrado = $quebra[1];
$zeros = 0;
$valorProcurado = 0;
$unique = md5(uniqid(rand(), true));

//$sum = number_format($valorRecebido + ($valorRecebido * 50 / 100), 8,  '.', '');
switch ($valorQuebrado) {
		case strstr($valorQuebrado, '0000000'):
		$perc = number_format(0.00000001, 8, '.', '');
		$dif = number_format($valorRecebido - $perc, 8, '.', '') > $perc ? number_format($valorRecebido - $perc, 8, '.', '') : $perc;
		$sum = number_format($valorRecebido, 8,  '.', '') > $dif ? number_format($valorRecebido, 8,  '.', '') : number_format($valorRecebido + $perc, 8, '.', '');
		$retorno = array($unique, $pair, $perc, $dif, $sum, 0, 0, 0, 0, 0, 0, 0, 0, false);
	
		echo json_encode($retorno);
		break;
		case strstr($valorQuebrado, '000000'):
		$perc = number_format(0.00000001, 8, '.', '');
		$dif = number_format($valorRecebido - $perc, 8, '.', '');
		$sum = number_format($valorRecebido, 8,  '.', '');
		$retorno = array($unique, $pair, $perc, $dif, $sum, 0, 0, 0, 0, 0, 0, 0, 0, false);
		echo json_encode($retorno);
		break;
		case strstr($valorQuebrado, '00000'):
		$perc = number_format(0.00000001, 8, '.', '');
		$dif = number_format($valorRecebido - $perc, 8, '.', '');
		$sum = number_format($valorRecebido, 8,  '.', '');
		$retorno = array($unique, $pair, $perc, $dif, $sum, 0, 0, 0, 0, 0, 0, 0, 0, false);
		echo json_encode($retorno);
		break;
		case strstr($valorQuebrado, '0000'):
		$perc = number_format(0.00000005, 8, '.', '');
		$dif = number_format($valorRecebido - $perc, 8, '.', '');
		$sum = number_format($valorRecebido, 8,  '.', '');
		$retorno = array($unique, $pair, $perc, $dif, $sum, 0, 0, 0, 0, 0, 0, 0, 0, false);
		echo json_encode($retorno);
		break;
		case strstr($valorQuebrado, '000'):
		$perc = number_format(0.00000050, 8, '.', '');
		$dif = number_format($valorRecebido - $perc, 8, '.', '');
		$sum = number_format($valorRecebido, 8,  '.', '');
		$retorno = array($unique, $pair, $perc, $dif, $sum, 0, 0, 0, 0, 0, 0, 0, 0, false);
		echo json_encode($retorno);
		break;
		case strstr($valorQuebrado, '00'):
		$perc = number_format(0.00000500, 8, '.', '');
		$dif = number_format($valorRecebido - $perc, 8, '.', '');
		$sum = number_format($valorRecebido, 8,  '.', '');
		$retorno = array($unique, $pair, $perc, $dif, $sum, 0, 0, 0, 0, 0, 0, 0, 0, false);
		echo json_encode($retorno);
		break;
		case strstr($valorQuebrado, '0'):
		$perc = number_format(0.00005000, 8, '.', '');
		$dif = number_format($valorRecebido - $perc, 8, '.', '');
		$sum = number_format($valorRecebido, 8,  '.', '');
		$retorno = array($unique, $pair, $perc, $dif, $sum, 0, 0, 0, 0, 0, 0, 0, 0, false);
		echo json_encode($retorno);
		break;
		default:
		$perc =  number_format(0.00050000, 8, '.', '');
		$dif = number_format($valorRecebido - $perc, 8, '.', '');
		$sum = number_format($valorRecebido, 8,  '.', '');
		//  uniqueid, moeda, taxa, menos, mais, preço atual, quantidade buy, total buy, quantidade sell, total sell,  tipo trade, mode auto, orderNumber
		$retorno = array($unique, $pair, $perc, $dif, $sum, 0, 0, 0, 0, 0, 0, 0, 0, false);
		echo json_encode($retorno);
		break;
}



 ?>
