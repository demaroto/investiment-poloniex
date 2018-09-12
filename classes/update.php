<?php 
namespace App;
session_start();

//require_once 'IConn.php';

require_once '../vendor/autoload.php';
require_once 'conexao.php';



if(isset($_POST))

{

  include_once 'conexao.php';

       $db = new \App\Conn(HOST_SERVER, DB_SERVER, USER_SERVER, PASS_SERVER);
       $serviceRun = new \App\ServiceRun($db);
        $configs = $_POST['configs'];
        $taxas = $_POST['taxas'];
        array_push($configs, $_SESSION['id']);
         array_push($taxas, $_SESSION['id']);

       
        if($serviceRun->addConfig($configs, $taxas)){
          $moeda = strtoupper($configs[0]);
          echo json_encode('<span class="alert alert-success">'.$moeda.': Configurações adicionadas</span>');
        }else{
          echo json_encode('<span class="alert alert-danger">'.$moeda.': Error ao configurar</span>');
        }
       

         

}



 ?>