 <?php 

session_start();

if(isset($_SESSION['username']))
        {
         
          header("location: index.php");
        }
  ?>
 <!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Script Poloniex :: Login</title>
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
      
<div class="container-fluid">
<div class="row">
    <nav class="navbar navbar-inverse navbar-fixed-top"> 	
     		
     	<div class="container">
    	<form class="navbar-form navbar-inverse navbar-fixed-top" role="login" method="post" >
  <div class="form-group">
    <input type="text" class="form-control inputText" name="email" id="login-email" placeholder="E-mail">
    <input type="password" class="form-control inputText" name="pass" id="login-pass"  placeholder="Password">
  </div>
  <button type="button" onclick="login();" id="login-submit" class="btn btn-success">Submit</button>
  <span class="alert alert-danger" role="alert" id="result-login">
    <span class="glyphicon glyphicon-exclamation-sign" id="result"></span>

  </span>
</form>

</div>

</nav>

<br />
<br />
<br />
</div>

<div class="container">

<div class="row">
	<div class="pan-login bgColor2">
	<div class="col-md-12">
		<div class="col-md-4">
			<h1>Cadastre-se</h1>
		</div>

	<div class="col-md-8">

	<div class="input-group">
  <span class="input-group-addon" id="basic-addon1"></span>
  <input type="text" class="form-control" id="cad_email" name="mail" placeholder="E-mail" aria-describedby="basic-addon1">


</div>
  <br />
		<div class="input-group">
  <span class="input-group-addon" id="basic-addon1"></span>
  <input type="password" class="form-control" id="cad_pass" name="pass" placeholder="Password" aria-describedby="basic-addon1">


</div>
  <br />
			<div class="input-group">
  <span class="input-group-addon" id="basic-addon1"></span>
  <input type="password" class="form-control" id="cad_key" name="key" placeholder="Key Poloniex" aria-describedby="basic-addon1">
  

</div>
<br />

		<div class="input-group">
  <span class="input-group-addon" id="basic-addon1"></span>
  <input type="password" class="form-control" name="secret" id="cad_secret" placeholder="Secret Poloniex" aria-describedby="basic-addon1">
    

</div>
  <br />

<button type="button" class="btn btn-primary" onclick="cadastrar();">Cadastrar</button>
	</div>
<span id="cadastro"></span>


	</div>

	</div>
</div>
</div>
</div>
    </body>
          <script src="js/jquery-3.1.0.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/login.js"></script>
    </html>