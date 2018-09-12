

  <?php 

  session_start();



  if(!isset($_SESSION['username']))

        {

         

          header("location: login.php");

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

         

          if(count($access) > 0)

          {

            $key = $access->key;

            $secret = $access->secret;

          }





         $poloniex = new \App\poloniex($key, $secret);

         $service = new \App\ServiceOrder($db, $order, $poloniex);





          

   ?>

  <!DOCTYPE html>

  <html lang="en">

    <head>

      <meta charset="utf-8">

      <meta http-equiv="X-UA-Compatible" content="IE=edge">

      <meta name="viewport" content="width=device-width, initial-scale=1">

      <title>Robo Poloniex :: Configurações</title>

      <link href="css/bootstrap.min.css" rel="stylesheet">

      <link rel="stylesheet" type="text/css" href="css/style.css">



    </head>

    <body>

kkkkkkkkkkkkk

    



          

    

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

            <div id="navbar" class="navbar-collapse">



            <ul class="nav navbar-nav">

      

                <li><a href="/"><span class="glyphicon glyphicon-home"></span> Home</a></li>

                <li class="active">

                    <a href="engine.php" id="config-home" name="config-home"><span class="glyphicon glyphicon-cog"></span> Options</a>

                </li>

                        

                </ul>

                </div>



    </div>

        </nav>

   

      <div class="container">

      <div class="row">

 

                  <nav data-toggle="tab">   

      <ul class="nav nav-tabs" role="tablist" id="mytabs">



    <li role="presentation" class="active">

    <a href="#keysecret" aria-controls="keysecret" role="tab" data-toggle="tab">Key / Secret</a></li>

    <li role="presentation"><a href="#taxas" aria-controls="taxas" role="tab" data-toggle="tab">Taxas</a></li>

    <li role="presentation"><a href="#changePass" aria-controls="changePass" role="tab" data-toggle="tab">Trocar Senha</a></li>

    <li role="presentation"><a href="#deposit" aria-controls="deposit" role="tab" data-toggle="tab">Depósito</a></li>

  </ul>



  <!-- Tab panes -->

  <div class="tab-content" id="tab-content">

    <div role="tabpanel" class="tab-pane active" id="keysecret">Key Secret</div>

    <div role="tabpanel" class="tab-pane" id="taxas">

   <form class="form-horizontal">

   <div class="form-group">

   <label for="pair" class="col-md-2 control-label">Pair</label>

   <div class="col-md-3">

     

 

      <select class="form-control" id="pair">

           <?php 

      //Taxas



      $tx = isset($_GET['tx']) ? $_GET['tx'] : false;

      if($tx != false)

      {

        $url = $_GET['tx'];

      echo  "<option>{$url}</option>";

          //var_dump($service->getEngine(1));

      }else{

        echo 'Selecione a moeda';

        foreach ($service->findBalance() as $key => $value) {

          $pair_btc = explode("_", $key)[0];

          if($pair_btc == 'BTC')

          {

            echo  "<option>{$key}</option>";

          }

        }

      } 

       ?>

       </select>

         </div>

       </div>

         <div class="form-group">

             <label for="btc" class="col-md-2 control-label">BTC</label>

             <div class="col-md-3">

               <input type="text" class="form-control" id="btc" placeholder="BTC" />

             </div>

             

        </div>

          <div class="form-group">

             <label for="osc" class="col-md-2 control-label">Oscilation</label>

             <div class="col-md-3">

               <input type="text" class="form-control" id="osc" placeholder="Oscilation" />

             </div>

             

        </div>

        <div class="col-md-12">

            <button type="button" class="btn btn-info"><span class="glyphicon glyphicon-floppy-save"></span> Save</button>

        </div>

       

       </form>

    </div>

    <div role="tabpanel" class="tab-pane" id="changePass">Trocar a senha</div>

    <div role="tabpanel" class="tab-pane" id="deposit">Depositar</div>

  </div>

</nav>





  </div>     

</div>

<footer>

    <div class="container-fluid">

    

    <h5 align="center" id="direitos" data-toggle="popover" data-content="Developer: Wildemar Barbosa ||| Email: demaroto69@gmail.com" data-placement="top">

    &copy; Todos os direitos reservados 2016 - <?= date('Y')?>      

    </h5>

   </div>



</footer>



      </body>



      

      <script src="js/jquery-3.1.0.min.js"></script>

      <script src="js/transition.js" type="text/javascript"></script>

      <script src="js/bootstrap.min.js"></script>

      <script>

        $(function () {

      $('[data-toggle="popover"]').popover();



      $("#direitos").click(function(){

        $(this).popover();

      });

        });

      </script>

  </html>