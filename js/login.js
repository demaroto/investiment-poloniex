
	function login()
	{

		email = $("#login-email").val();
		pass = $("#login-pass").val();
		if(email !== '' && pass !== '')
		{
			$.get('classes/validation.php', {'email' : email, 'pass' : pass}, function(retorno){
				if(retorno == true)
				{

					$("#result-login").hide();
					$("#login-submit").text('Entrando..');
					document.location.href = '/';
				}else{
					$("#result-login").show().delay(3000).fadeOut();
					$("#result").show().html(' ' + retorno);
				}
			}, 'JSON');

		}
	}
$("#login-pass, #login-email").keyup(function(e){
	if(e.keyCode == 13)
	{
		login();
	}
});

function cadastrar(){
	var email = $("#cad_email").val();
	var pass = $("#cad_pass").val();
	var key = $("#cad_key").val();
	var secret = $("#cad_secret").val();
	$.get('classes/cadastrar.php', {'email' : email, 'pass' : pass, 'key': key, 'secret' : secret}, function(cadastro){
		console.log(cadastro);
		$("#cadastro").html('<h3>'+cadastro+'</h3>');
	}, 'JSON');
}