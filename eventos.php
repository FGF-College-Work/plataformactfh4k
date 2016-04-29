<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 sec_session_start();


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Bem-Vindo ao CTF Sucuri HC " />
	<meta name="author" content="" />

	<title>CTF-H4K Eventos</title>
  
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="assets/css/flipclock.css">

		<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->

	<script src="assets/js/flipclock.js"></script>	

	<link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
	<!--<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">-->
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/neon-core.css">
	<link rel="stylesheet" href="assets/css/neon-theme.css">
	<link rel="stylesheet" href="assets/css/neon-forms.css">
	<link rel="stylesheet" href="assets/css/custom.css">

	<script src="assets/js/jquery-1.11.0.min.js"></script>
	<script>$.noConflict();</script>
    
	<!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->


</head>
<body class="page-body">
<?php if (login_check($mysqli) == true) : ?>
<div class="page-container horizontal-menu">

	
	<header class="navbar navbar-fixed-top">
		
		<div class="navbar-inner">
			
			<!-- main menu -->
						
			<ul class="navbar-nav">
				<li class="opened active">
					<a href="#">
						<i class="entypo-gauge"></i>
						<span class="title">Eventos</span>
					</a>
				</li>
				<li class="">
					<a href="profile.php">
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
                <br><br>
				<div class="col-md-12">
	            <center><img src="assets/images/1logo.png"></center>			
				<h4>Eventos</h4>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>#</th>
							<th><center>Data Inicio</center></th>
							<th><center>Formato FLAG</center></th>
                            <th><center>Acesso</center></th>
                            <th><center>Ranking</center></th>
						</tr>
					</thead>
					
					<?php carregaeventos($mysqli); ?>
				</table>

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
