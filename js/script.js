$(function(){

var refresh = 0;
var key = $("#key").val();
var secret = $("#secret").val();
var favorites = 0;
var working = "";
 
function workingPair() {

      


    }
function atualizando(){
  var setAtualiza = setTimeout(function(){  

         $(".select_moeda").click(function(){
          console.log('Clicou para selecionar moeda');

         });
         
  $.post('classes/bidAsk.php', {}, function(data){
            
            $("#poloniex-data").html(data);
      }, 'JSON');

// Recupera balanças
  
          
  $.post('classes/working.php', {}, function(work){
            
            $("input[name='workingPair']").val(work);
      }, 'JSON');
var listBalance = [];
    
 $.get('classes/balances.php', {'action' : 'all', 'pair' : 'no'}, function(balance){
  $('.overflowTable').html('');
     
      $.each(balance, function(b){

        pair = b.split('_')[0];


     

        if(pair === 'BTC')
        {
          
          volume = Number(balance[b]['baseVolume']).toFixed(3);
          change = Number(balance[b]['percentChange'] * 100).toFixed(2);
          listBalance.push({'pair': b, 'zero': 0, 'price': balance[b]['last'], 'volume': balance[b]['baseVolume'], 'btc': '', 'change': change});
           
     
        }

         
        });

      
      function compare(a,b) {

    return b.volume - a.volume;
    }     

  
      listBalance.sort(compare);
       
    
          
  
          
           for(i = 0; i < listBalance.length; i++){
            working = $("input[name='workingPair']").val();
           
                if(listBalance[i]['change'] >= 0)
          {
            change = '<span class="positive">+'+listBalance[i]['change'] +'</span>';
          }else{
            change = '<span class="negative">'+listBalance[i]['change'] +'</span>';
          }
         
          if(listBalance[i]['pair'] == working){
            checked = "checked";
          }else{
            checked = "";
          }


           $('.overflowTable').append("<tr><td class='favorite' alt='"+listBalance[i]['pair']+"' width='5%'><span class='glyphicon glyphicon-star-empty'></span></td><td width='5%' class='check_trade' title="+listBalance[i]['pair']+"><input type='checkbox' name='start-pair' "+checked+" value='"+listBalance[i]['pair']+"'></td><td class='select_pair'>"+listBalance[i]['pair']+"</td><td width='5%'>"+listBalance[i]['zero']+"</td><td>"+listBalance[i]['price']+"</td><td>"+Number(listBalance[i]['volume']).toFixed(3)+"</td><td width='5%'></td><td>"+change+"</td></tr>");
          

          }
      $("input[name='start-pair']").change(function(){
            var check = $(this).prop('checked');
             var parar = $("input[name='check-parar']").prop('checked');
             var auto = $("input[name='check-auto']").prop('checked');
            var btc = $("input[name='pago']").val();
            var limit = $("input[name='limit']").val();
            var taxa = $("input[name='taxa1']").val();
             var delay = $("input[name='delay']").val();
            var configs = [$(this).val(), btc, limit, taxa, delay, 0, 0, 0, 0, auto, parar, 0];
             var taxa8 = $("input[name='taxa8']").val();
             var taxa7 = $("input[name='taxa7']").val();
             var taxa6 = $("input[name='taxa6']").val();
             var taxa5 = $("input[name='taxa5']").val();
             var taxa4 = $("input[name='taxa4']").val();
             var taxa3 = $("input[name='taxa3']").val();
             var taxa2 = $("input[name='taxa2']").val();
             var taxa1 = $("input[name='taxa1']").val();

            var taxas = [taxa1, taxa2, taxa3, taxa4, taxa5, taxa6, taxa7, taxa8];  
              if (check){
               $.post('classes/update.php',{'configs' : configs, 'taxas' : taxas}, function(success){
                console.log(success);
                $("#res").hide().html(success).fadeIn(100).delay(5000).fadeOut(100);
               }, 'JSON');
              }
          
      });

      $('.favorite').click(function(){
          pair = $(this).attr('alt');
          $.get('classes/favorites.php',{'pair' : pair, 'action' : 'save'}, function(retorno){
        
          }, 'JSON');
      });

      $('.remfavorite').click(function(){

          pair = $(this).attr('alt');
          $(this).html("<span class='glyphicon glyphicon-trash'></span>");
          $.get('classes/favorites.php',{'pair' : pair, 'action' : 'delete'}, function(retorno){
            console.log(retorno);
          }, 'JSON');
      });

    $.get('classes/showfavorites.php', function(retorno){
            //console.log(retorno);
         $('.balances_favorites').html('');
            if(retorno.length > 0)
            {
              $.each(retorno, function(e){
              
                pair = retorno[e]['pair'];
                price = retorno[e]['price'];
                volume = retorno[e]['volume'];
                change = retorno[e]['change'];
                if(change >= 0)
          {
            change = '<span class="positive">+'+change+'</span>';
          }else{
            change = '<span class="negative">'+change+'</span>';
          }

                $('.balances_favorites').append("<tr><td class='remfavorite' alt='"+pair+"' width='5%'><span class='glyphicon glyphicon-star'></span></td><td width='5%' class='check_trade' title="+pair+"></td><td class='select_pair'>"+pair+"</td><td width='5%'>0</td><td>"+price+"</td><td>"+volume+"</td><td width='5%'></td><td>"+change+"</td></tr>");
              });
              

            }else{
             // console.log('Não há favoritos!');
            }

    }, 'JSON');

    $('.select_pair').click(function(){
      window.location.href = '/config?tx=' + $(this).text();
      console.log(window.location.href);
});

  



 }, 'JSON').done(function(){
  //Exibir Favoritos
  atualizando();


 }).fail(function(f){
  $("#res").html("Oops! Atualizando a página");

  console.log(f);
 });
 
}, 5000);
}
atualizando();

        
       $("#find_moeda").keypress(function(e){

    
    if($(this).val() != '')
    {

    pair = 'BTC_' + $(this).val();
    pair = pair.toUpperCase();
      $('.overflowTable').slideUp();
        $.get('classes/balances.php', {'action' : 'find', 'pair' : pair}, function(balance){
    
          pair = 'BTC_' + $("#find_moeda").val();
          pair = pair.toUpperCase();
          price = balance[pair]['last'];
          volume = Number(balance[pair]['baseVolume']).toFixed(3);
          change = Number(balance[pair]['percentChange'] * 100).toFixed(2);
          if(change >= 0)
          {
            change = '<span class="positive">+'+change+'</span>';
          }else{
            change = '<span class="negative">'+change+'</span>';
          }

          $('.balances_filter').html("<tr><td class='favorite' alt='"+pair+"' width='5%'><span class='glyphicon glyphicon-star'></span></td><td width='5%' class='check_trade' title="+pair+"></td><td class='select_pair'>"+pair+"</td><td width='5%'>0</td><td>"+price+"</td><td>"+volume+"</td><td width='5%'></td><td>"+change+"</td></tr>");
        }, 'JSON');

    }else if($(this).val() == ''){
      $('.balances_filter').html('');
      $('.overflowTable').slideDown();
    }
    
  });

  

});

