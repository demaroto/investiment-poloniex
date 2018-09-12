
  <?php 


header('Content-Type: text/html; charset=utf-8');
  session_start();

  if(!isset($_SESSION['username']))
        {
         
          header("Location: login.php");
          exit;
        }
        



      date_default_timezone_set('America/Sao_Paulo');
        require_once 'vendor/autoload.php';
        include_once 'classes/conexao.php';
         $db = new \App\Conn(HOST_SERVER, DB_SERVER, USER_SERVER, PASS_SERVER);
         $user = new \App\User;
         $user->setUser($_SESSION['username'])->setPassIndex($_SESSION['pass']);

         $trade = new \App\Trade($db, $user);
         $order = new \App\Order;
         $access = $trade->access();
         $_SESSION['id'] = $access->id;
          if(count($access) > 0)
          {
            $user->setKey($access->key_poloniex);
            $user->setSecret($access->secret_poloniex);
            $user->setId($access->id);
            $order->setIdUser($user->getId());
          }
          
           try {
          $poloniex = new \App\poloniex($user->getKey(), $user->getSecret());

                  
         $service = new \App\ServiceOrder($db, $order, $poloniex);
         $service_user = new \App\ServiceUser($db, $user, $poloniex);
         $user->setSaldo($service_user->getBalance('BTC'));
         
         $rout = new App\Route;
         $url = $_SERVER['REQUEST_URI'];
          $url = parse_url($url, PHP_URL_QUERY);
          $url2 = $url;
      
          $url2 = count(explode("&", $url2)) > 1 ? explode("&", $url2) : '';
          $url = count(explode("pg=", $url)) > 1 ? explode("pg=", $url) : array(1 => 'home');
          if($url2 > 2)
          {
          $url5 = explode("tx=",$url2[0])[0];
          $url4 = explode("pg=",$url2[0])[1];
          $url3 = array(0 => $url4, 1 => $url5[1]); 
          }else{
          $url3 = array(0 => $url[1]); 
          }
          $action = $rout->Router($url3[0])['action'];
        $pg = new \App\IndexController;
                    
         } catch (Exception $e) {
           echo "<h1>Erro de conexão!</h1>";
           exit;
         }
        
       

         

   ?>
   <!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Script Poloniex</title>
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>

  <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a href="/" id="navTitle"><img src="media/images/logo.png" class="img-rounded navImg" height="40px" alt=""></a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="/"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                <li>
                    <a href="#" name="config" style="color:#00F5FF"><span class="glyphicon glyphicon-cog"></span> Configurar</a>
                </li>
                <li class="texto btc">
              <span class="glyphicon glyphicon-bitcoin"></span>
              <p id="balance_btc"><?= $user->getSaldo(); ?></p>
               </li>
               
                  
            </ul>
            
            <button type="button" class="btn btn-danger exit" id="exit"><span class="glyphicon glyphicon-off"></span> Sair </button>
          </div><!--/.nav-collapse -->

        </div>
      </nav>
<div class="container" id="pageP">
<?php 

 
  include_once $pg->$action();


 ?>
</div>



<footer>
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      
      </div>
      <div class="modal-body">
          <h4>Deseja sair ?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
        <button type="button" class="btn btn-primary" id="confirmExit">Sim</button>
      </div>
    </div>
  </div>
</div>      
  <div class="container-fluid">
    
    <h5 align="center" id="direitos" data-toggle="popover" data-content="Developer: Wildemar Barbosa | E-mail: demaroto69@gmail.com" data-placement="top">
    &copy; Todos os direitos reservados à Eudes | 2016 - <?php echo date('Y'); ?>
    <p>Desenvolvido por Wildemar da Silva Barbosa</p>      
    </h5>
    
   </div>

      </footer>

      </body>
      </html>
