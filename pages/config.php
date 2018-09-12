  <div class="container">   

      <div class="row col-md-6">

 

                  <nav data-toggle="tab">   

      <ul class="nav nav-tabs" role="tablist" id="mytabs">



    <li role="presentation" class="active">

    <a href="#keysecret" aria-controls="keysecret" role="tab" data-toggle="tab">Key / Secret</a></li>

    <li role="presentation"><a href="#taxas" aria-controls="taxas" role="tab" data-toggle="tab">Taxas</a></li>

    <li role="presentation"><a href="#changePass" aria-controls="changePass" role="tab" data-toggle="tab">Trocar Senha</a></li>

    <li role="presentation"><a href="#deposit" aria-controls="deposit" role="tab" data-toggle="tab">Dep√≥sito</a></li>

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

                 <caption class="text-center">Configura√ß√µes</caption>

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

      <script src="js/transition.js" type="text/javascri1Çqò%u_‘≈Dı⁄åfL†p/4∂i˚√=•WSú‹˚JæaO~ò„ú—%‡∆N±T‘yCIÑ·ˆK«8ÎfÙM»ˆÚ°≈Å®‡–<ßˆªPŸ£0rkÕπ°çäºüU∆TåÈ–N6ÈD Â®RÜâ”WùÌÛZÇîí1E˝π˝ì'ßëµm∂TVÂf›µÿ3ÂYÎQ≠ç¿¬[\¶√[¬k¸gí¨0‚#u;äK[=ÆÁEa¢±eU≤:^á÷5ˇÅ◊V§X9…3eóúU<>¡mŸ);Œæ $xÏh˚—25ööÊeNlËD«‘Wm!,Ó“Öêíåi*"õ')‰íhÀvxÇLƒŸıTí≠$ñß7s™<QíöWmX≠ÙÄÇ
MQí@7≈Æ* °hÃbt?ÕÀaXnÓÙıé!î≈¬âeqP`tF0Ñ,Ùc´Â<ƒ‹ÂzÍM⁄ÚÎﬂÄêLã©X{nﬂ?£ëa<˛;’1ﬁ ÈµÖhÉ‚·≈)é<∫XJEhîΩll˝$8W¬ærœ?≤}„Ê!Åá˘7[∆—pX¢èÑL=œFi5øö"+æoŒÕ$†¡òÜföI€vË£$•"êŒ‚ëLEGÖq
Œ¶voŒ“}ö∞ôõ.ìﬂK;¡∂ÿeÉ.c1*z”&GB•rh5u_*2ÑjWπwåCK^
TD)¥œm7q¥ƒq“¨ú*Ä›€dp˜!¬>	oßÚÃpI¬ªÌ⁄—wM‘ÿıh’1 Bqö…EX81ùVç_òñ3*,0∆ Ò€KËäìÑÒµ…‘J9/6@’	 RÊéÍ*b0hπÕ}Ïëï5J‘…nßF™Ö¿—◊øŸ≠zY$˛=ERÖŸû}*é{´#1œò∑Ñ†¨z!îÌÂÖHcUèÖÓô¢SÑÂ|‘Û∆≤§E (	»{≈≥Bèf˝_±0(9˙l÷Ó]K≠MQÊÂÃ4