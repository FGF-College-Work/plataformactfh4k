<<<<<<< HEAD
<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
 
if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Bem-Vindo ao CTF Sucuri HC " />
	<meta name="author" content="" />

	<title>CTF-H4K</title>

	<link rel="stylesheet" href="assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
	<link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/neon-core.css">
	<link rel="stylesheet" href="assets/css/neon-theme.css">
	<link rel="stylesheet" href="assets/css/neon-forms.css">
	<link rel="stylesheet" href="assets/css/skins/black.css">
	<link rel="stylesheet" href="assets/css/custom.css">

	<script src="assets/js/jquery-1.11.0.min.js"></script>

	<script type="text/JavaScript" src="assets/js/sha512.js"></script> 
	<script type="text/JavaScript" src="assets/js/forms.js"></script> 
	<script>$.noConflict();</script>

	<!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->


</head>
<body class="page-body login-page login-form-fall" onload="document.getElementById('email').focus();">

	
<div class="login-container">
	
	<div class="login-content">
			
			<center><img src="assets/images/2logo.png" width="310" height="180"> </center>
			
			<?php
 				if(!empty($_POST) ){
   			 		recoverypassword($mysqli,$_POST['email']);
  				}else {
  					echo '<p class="description">Digite seu e-mail , e nós iremos enviar o link de redefinição.</p>';
  				}
			?>
			
		</div>
		
	</div>
	
	
	<div class="login-form">
		
		<div class="login-content">
			
			<form method="post">
				
					<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="entypo-mail"></i>
								</div>
								
								<input type="text" class="form-control" name="email" id="email" placeholder="Email" data-mask="email" autocomplete="off" />
							</div>
						</div>
						
						<div class="form-group">
							<button type="submit" class="btn btn-info btn-block btn-login">
								>>> Recovery
							</button>
							<button type="button" onclick="window.location.href='index.php'" class="btn btn-primary btn-block">
						<i class="entypo-user"></i>
						Return Login Page
					</button>
						</div>
						

					
					</div>	

				
				
			</form>
			
		
			</div>
			
		</div>
		
	</div>
	
</div>


	<!-- Bottom scripts (common) -->
	<script src="assets/js/gsap/main-gsap.js"></script>
	<script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/joinable.js"></script>
	<script src="assets/js/resizeable.js"></script>
	<script src="assets/js/neon-api.js"></script>
	<script src="assets/js/jquery.validate.min.js"></script>
	<script src="assets/js/neon-forgotpassword.js"></script>
	<script src="assets/js/jquery.inputmask.bundle.min.js"></script>


	<!-- JavaScripts initializations and stuff -->
	<script src="assets/js/neon-custom.js"></script>


	<!-- Demo Settings -->
	<script src="assets/js/neon-demo.js"></script>

</body>
</html>
=======
<h1>Perdi a Senha</h1>
<?php
  if( !empty($_POST) ){
    // processar o pedido
    mysql_connect('localhost', 'root', '');  // ligar à base de dados
    mysql_select_db('test');  // escolher a base de dados pretendida
 
    $user = mysql_real_escape_string($_POST['email']);
    $q = mysql_query("SELECT * FROM utilizadores WHERE email = '$user'");
 
    if( mysql_num_rows($q) == 1 ){
      // o utilizador existe, vamos gerar um link único e enviá-lo para o e-mail
 
      // gerar a chave
      // exemplo adaptado de http://snipplr.com/view/20236/
      $chave = sha1(uniqid( mt_rand(), true));
 
      // guardar este par de valores na tabela para confirmar mais tarde
      $conf = mysql_query("INSERT INTO recuperacao VALUES ('$user', '$chave')");
	  echo "INSERT INTO recuperacao VALUES ('$user', '$chave')";
 
      if( mysql_affected_rows() == 1 ){
 
        $link = "http://ctf.sucurihc.org/recuperar.php?utilizador=$user&confirmacao=$chave";
 
        if( mail($user, 'Recuperação de password', 'Olá '.$user.', visite este link '.$link) ){
          echo '<p>Foi enviado um e-mail para o seu endereço, onde poderá encontrar um link único para alterar a sua password</p>';
 
        } else {
          echo '<p>Houve um erro ao enviar o email (o servidor suporta a função mail?)</p>';
 
        }
 
		// Apenas para testar o link, no caso do e-mail falhar
		echo '<p>Link: '.$link.' (apresentado apenas para testes; nunca expor a público!)</p>';
 
      } else {
        echo '<p>Não foi possível gerar o endereço único</p>';
 
      }
    } else {
	  echo '<p>Esse utilizador não existe</p>';
	}
  } else {
    // mostrar formulário de recuperação
?>
<form method="post">
  <label for="email">E-mail:</label>
  <input type="text" name="email" id="email" />
  <input type="submit" value="Recuperar" />
</form>
<?php
  }
?>
>>>>>>> origin/master
