  <div class="container">   

      <div class="row col-md-6">

 

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

    <div role="tabpanel" class="tab-pane" id="keysecret">

        <form  method="get" accept-charset="utf-8" class="form-horizontal">

          <div class="form-group">

             <label for="btc" class="col-md-2 control-label">KEY</label>

             <div class="col-md-3">

               <input type="text" class="form-control" id="key" placeholder="Key Poloniex" />

             </div>

             

        </div>

          <div class="form-group">

             <label for="btc" class="col-md-2 control-label">SECRET</label>

             <div class="col-md-3">

               <input type="text" class="form-control" id="secret" placeholder="Secret Poloniex" />

             </div>

             

        </div>

        <button type="button" id="changeKeySecret" class="btn btn-success">Alterar</button>

        </form>

    </div>

    <div role="tabpanel" class="tab-pane active" id="taxas">

   <form class="form-horizontal">

   <div class="form-group">

   <label for="pair" class="col-md-2 control-label">Pair</label>

   <div class="col-md-6">

     

 

      <select class="form-control" id="pair" name="pair">

           <?php 

      //Taxas



      $tx = isset($_GET['tx']) ? $_GET['tx'] : false;

      if($tx != false)

      {

        $url = $_GET['tx'];

      echo  "<option>{$url}</option>";

          //var_dump($service->getEngine(1));

      }

       ?>

       </select>





         </div>

       </div>

         <div class="form-group">

             <label for="btc" class="col-md-2 control-label">BTC</label>

             <div class="col-md-6">

               <input type="text" class="form-control" id="btc" placeholder="BTC" />

             </div>

             

        </div>

          <div class="form-group">

             <label for="osc" class="col-md-2 control-label">Oscilation</label>

             <div class="col-md-6">

               <input type="text" class="form-control" id="osc" placeholder="Oscilation" />

             </div>

             

        </div>



              <div class="form-group">

             <label for="osc_sell" class="col-md-2 control-label">Oscilation Sell</label>

             <div class="col-md-6">

               <input type="text" class="form-control" id="osc_sell" placeholder="Oscilation Sell" />

             </div>

             

        </div>

          <div class="form-group">

             <label for="numberOrders" class="col-md-2 control-label">Numbers of Orders</label>

             <div class="col-md-6">

               <input type="text" class="form-control" id="numberOrders" placeholder="Numbers of Orders" />

             </div>

             

        </div>



     



        <div class="col-md-12">

            <button type="button" class="btn btn-info" id="saveEngine"><span class="glyphicon glyphicon-floppy-save"></span>Save</button>

        </div>

       

       </form>

           <div>

        

                 <table class="table-responsive text-center">

                 <caption class="text-center">Configurações</caption>

                <tbody>

                      <tr style="background-color: #222;">

                     <td>Pair</td>

                     <td>BTC</td>

                     <td>Buy</td>

                     <td>Sell</td>

                     <td>Volume</td>

                     <td>Status</td>

                     <td>Edit</td>

                     <td>Delete</td>

                     <td>Stop</td>

                     <td>Play</td>

                     </tr>     

                     <?php 

                     $engine = $service->listEngine();

                      for ($i=0; $i < count($engine); $i++) { 

                        $btc = $engine[$i]->btc;

                        $pair = $engine[$i]->pair;

                        $taxa = $engine[$i]->taxa;

                        $max_orders = $engine[$i]->max_orders;

                        $taxa_sell = $engine[$i]->taxa_sell;

                        $status = $engine[$i]->status;

                        echo "<tr><td>".$pair."</td>",

                        "<td>".$btc."</td>",

                        "<td>".$taxa."</td>",

                        "<td>".$taxa_sell."</td>",

                        "<td>".$max_orders."</td>",

                        "<td>".$status."</td>",

                       "<td><button class='btn btn-info' onClick=editEngine(".$pair.",".$btc.",".$taxa.",".$max_orders.",".$taxa_sell.")>Edit</button></td>",

                        "<td><button class='btn btn-danger delete' id=".$pair.">Delete</button></td>",

                        "<td><button class='btn btn-warning stop' id=".$pair.">Stop</button></td>",

                        "<td><button class='btn btn-success play' id=".$pair.">Play</button></td></tr>";

                      }

                      ?>

                   

                 </tbody>

                 </table>



           </div>

    </div>

    <div role="tabpanel" class="tab-pane" id="changePass">Trocar a senha</div>

    <div role="tabpanel" class="tab-pane" id="deposit">Depositar</div>

  </div>

</nav>

  </div>     
    <div class="col-md-6">

        <div id="balances">

          <table class="table-responsive">

            <caption> 

              <div class="input-group">

               <span class="input-group-addon"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>

            <input type="text" name="filter" id="find_moeda" placeholder="Buscar Moeda" class="form-control" />

            </div>

              <div id="hide_balances">

              <span class="glyphicon glyphicon-eye-close"></span>

              Hide Balances

            </div>

            <div id="show_balances" style="display:none">

            <span class="glyphicon glyphicon-eye-open"></span>

              Show Balances

            </div>

            </caption>

           

            <tr>

            <td id="sort_favorite" width='5%'><span class="glyphicon glyphicon-star" aria-hidden="true"></span></td>

            <td id="checkbox" width="5%">Start</td>

             <td id="sort_coin">Coin</td>

             <td id="howmuch" width='5%'>Orders</td>

             <td id="sort_price">Price</td>

              <td id="sort_volume" >Volume</td>

              <td id="havemoney" width="5%"><span class="glyphicon glyphicon-btc"></span></td>

              <td id="sort_change">Change</td>

            </tr>



            <tbody class="balances_favorites overflowFavorite">

             



            </tbody>

            <tbody class="data_balances overflowTable">

              

            </tbody>

            <tbody class="balances_filter">

              

            </tbody>

          

          </table>

        </div>



      </div>

</div>





      

      <script src="js/jquery-3.1.0.min.js"></script>

      <script src="js/script.js" type="text/javascript"></script>

      <script src="js/transition.js" type="text/javascri1�q�%u_��D���fL�p/4�i��=�WS���J�aO~���%��N�T�yCI���K�8�f�M���Ł���<���P٣0rk͹�����U�T���N6�D �R���W���Z���1E����'���m�TV�f���3�Y�Q����[\��[�k�g��0�#u;�K[=��Ea��eU�:^��5���V�X9�3e��U<>�m�);ξ�$x�h��25���eNl�D��Wm!,�҅���i*"�')�h�vx�L���T��$��7s�<Q��WmX��
MQ�@7Ů* �h�bt?��aXn����!��eqP`tF0�,�c��<���z�M���߀�L��X{n�?��a<�;�1� 鵅h����)�<�XJEh��ll�$8W¾r�?�}��!���7[��pX���L=�Fi5��"+�o��$����f�I�v�$�"���LEG�q
Φvo���}����.��K;���e�.c1*z�&GB�rh5u_*2�jW�w�CK^
TD)��m7q��qҬ�*���dp�!�>	o���pI�����wM���h�1 Bq��EX81�V�_��3*,0� ��K芓�����J9/6@�	 R��*b0h��}쑕5J��n�F����׿٭zY$�=ER�ٞ}*�{�#1Ϙ����z!���HcU��S��|��Ʋ�E�(	�{ųB�f�_�0(9�l��]K�MQ���4