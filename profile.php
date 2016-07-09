<?php
require_once 'class/Conexao.php';
require_once 'class/usuario.php';

session_start();

$usuario = new usuario();
$usuario->setUser($_SESSION['user_id'])

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Bem-Vindo ao CTF Sucuri HC " />
	<meta name="author" content="" />

	<title>CTF-H4K Profile</title>
  
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="assets/css/flipclock.css">


	<link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/neon-core.css">
	<link rel="stylesheet" href="assets/css/neon-theme.css">
	<link rel="stylesheet" href="assets/css/neon-forms.css">
	<link rel="stylesheet" href="assets/css/custom.css">

	<script src="assets/js/jquery-1.11.0.min.js"></script>
	<script>$.noConflict();</script>
    
</head>
<?php
if (isset($_POST['username'])) {
    $username = $_POST['username']; 
    
	if ($usuario->atualizaNome($username) == true) {
	  echo '<script>alert("Username Alterado com sucesso!")</script>';
    } else {
      echo '<script>alert("Não foi possivel alterar para esse username!")</script>';
    }
	
}
?>

<body class="page-body">
<?php if (isset($_SESSION['username'])) : ?>
<div class="page-container horizontal-menu">

	
	<header class="navbar navbar-fixed-top">
		
		<div class="navbar-inner">
			
			<!-- main menu -->
						
			<ul class="navbar-nav">
				<li class="opened active">
					<a href="eventos.php">
						<i class="entypo-gauge"></i>
						<span class="title">Eventos</span>
					</a>
				</li>
				<li class="opened active">
					<a href="#">
						<i class="entypo-user"></i>
						<span class="title">Profile</span>
					</a>
				</li>
				<li class="">
					<a href="#">
						<i class="entypo-layout"></i>
						<span class="title">Team</span>
					</a>
					<ul>
						<li>
							<a href="newteam.php">
							<i class="entypo-layout"></i>
							<span class="title">Novo Team</span>
							</a>
						</li>
						<li>
							<a href="enterteam.php">
							<i class="entypo-layout"></i>
							<span class="title">Enter Team</span>
							</a>
						</li>
					</ul>
				</li>
			</ul>
						
			
			<!-- notifications and other links -->
			<ul class="nav navbar-right pull-right">
				<li class="dropdown">
					<a href="/includes/logout.php">
						Log Out <i class="entypo-logout right"></i>
					</a>
				</li>	
			</ul>
		</div>
	</header>
    
	<div class="main-content">

		<div class="container">
			<div class="row">
                
				<form role="form" method="post" class="form-horizontal form-groups-bordered validate" action="">
		
			<div class="row">
				<div class="col-md-12">
					
					<div class="panel panel-primary" data-collapsed="0">
					
						<div class="panel-heading">
							<div class="panel-title">
								Configurações Gerais
							</div>
							
						</div>
						
						<div class="panel-body">
				
							<div class="form-group">
								<label for="field-1" class="col-sm-3 control-label">Username:</label>
								
								<div class="col-sm-5">
									<input type="text" class="form-control" name="username" value="<?php echo $_SESSION['username']; ?>" autofocus>
								</div>
							</div>
			
							<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label">Time:</label>
								
								<div class="col-sm-5">
                                                                    <input type="text" class="form-control" id="time" value="<?php $usuario->carregaNomeTeam(); ?>">
								</div>
							</div>

							<div class="form-group">
								<div <div class="col-sm-offset-3 col-sm-5">
									<button type="submit" class="btn btn-success">Salvar Alterações</button>
									<button type="button" onclick="window.location='alterar_senha.php'" class="btn btn-info">Alterar Senha</button>
								</div> 
							</div>
							
						</div>
					
					</div>
				
				</div>
			</div>
						
		</form>

		<div class="row">
			<div class="col-sm-3 col-xs-6">
		
				<div class="tile-stats tile-green">
					<div class="icon"><i class="entypo-flag"></i></div>
                                        <div class="num" data-start="0" data-end="<?php $usuario->totalFlagResolvidas(); ?>" data-postfix="" data-duration="1500" data-delay="0">0</div>
		
					<h3>Flags Resolvidas</h3>
					<p>All events</p>
				</div>
		
			</div>
		
			<div class="col-sm-3 col-xs-6">
		
				<div class="tile-stats tile-blue">
					<div class="icon"><i class="entypo-chart-bar"></i></div>
                                        <div class="num" data-start="0" data-end="<?php $usuario->totalEventos(); ?>" data-postfix="" data-duration="1500" data-delay="600">0</div>
		
					<h3>Eventos</h3>
					<p> :)</p>
				</div>
		
			</div>
		
			<div class="col-sm-3 col-xs-6">
		
				<div class="tile-stats tile-green">
					<div class="icon"><i class="entypo-infinity"></i></div>
                                        <div class="num" data-start="0" data-end="<?php $usuario->totalPontos(); ?>" data-postfix="" data-duration="1500" data-delay="1200">0</div>
		
					<h3>Pontos</h3>
					<p>Totalizador de todos eventos!</p>
				</div>
		
			</div>
		
			<div class="col-sm-3 col-xs-6">
		
				<div class="tile-stats tile-blue">
					<div class="icon"><i class="entypo-calendar"></i></div>
					<div class="num" data-start="0" data-end="0" data-postfix="" data-duration="1500" data-delay="1800">0</div>
		
					<h3>Em breve</h3>
					<p>Totalizador Team</p>
				</div>
		
			</div>
		</div>
		
				
				
				
				
              </div>
				
       <br><br>
	   <br><br>
	   <br><br>
	   <br><br>
	   
<!-- Footer -->
<footer class="main">
	
	&copy; 2016 <strong>CTF-H4k</strong>

</footer>

</div>
</div>
</div>
</div>

<script src="assets/js/toastr.js"></script>
	<?php else : ?>
            <p>
                <span class="error">Você não tem autorização para acessar esta página.</span> Login <a href="../index.php">login</a>.
            </p>
        <?php endif; ?>

    <script src="assets/js/gsap/main-gsap.js"></script>
	<script src="assets/js/joinable.js"></script>
	<script src="assets/js/resizeable.js"></script>
	<script src="assets/js/neon-custom.js"></script>
	
</body>
</html>
