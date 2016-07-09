<?php
session_start();
require_once 'class/Conexao.php';
require_once 'class/ranking_team.php';
if (isset($_GET['evento'])):
    $score = new ranking_team();
    $score->setEvento($_GET['evento']);
    
endif;
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
  
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
  

	<link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/neon-core.css">
	<link rel="stylesheet" href="assets/css/neon-theme.css">
	<link rel="stylesheet" href="assets/css/neon-forms.css">
	<link rel="stylesheet" href="assets/css/custom.css">

	<script src="assets/js/jquery-1.11.0.min.js"></script>
	<script>$.noConflict();</script>
    
	

</head>
<body class="page-body">
<div class="page-container horizontal-menu">

	
	<header class="navbar navbar-fixed-top">
		
		<div class="navbar-inner">
			
			<!-- main menu -->
						
			<ul class="navbar-nav">
				<li>
					<a href="roadsec.php">
						<i class="entypo-gauge"></i>
						<span class="title">Flags</span>
					</a>
					<li>
					<a href="eventos.php">
						<i class="entypo-layout"></i>
						<span class="title">Eventos</span>
					</a>
				</li>
					<li  class="opened active">
					<a href="#">
						<i class="entypo-layout"></i>
						<span class="title">Scoreboard</span>
					</a>
				</li>
			</ul>
						
			
			<!-- notifications and other links -->
			<ul class="nav navbar-right pull-right">
				<li class="dropdown">
					<a href="includes/logout.php">
						Log Out <i class="entypo-logout right"></i>
					</a>
				</li>	
			</ul>
		</div>
	</header>
    
	<div class="main-content">

		
			<div class="row">
                	<div class="col-md-12">
	            
               
                            <h4>RANKING: <?php echo $score->getNomeEvento(); ?></h4>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th><center>#</center></th>
							<th><center>TEAM</center></th>
                            <th><center>PONTUAÇÃO</center></th>
						</tr>
					</thead>
					
					<tbody>
                                            <?php
                                              $score->listar();
                                            ?>
					</tbody>
				</table>

                </div>
              </div>




       <br><br>
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

<!--teste-->


	<!-- Imported styles on this page -->
	<link rel="stylesheet" href="assets/js/jvectormap/jquery-jvectormap-1.2.2.css">
	<link rel="stylesheet" href="assets/js/rickshaw/rickshaw.min.css">

	<!-- Bottom scripts (common) -->
	<script src="assets/js/gsap/main-gsap.js"></script>
	<script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/joinable.js"></script>
	<script src="assets/js/resizeable.js"></script>
	<script src="assets/js/neon-api.js"></script>
	<script src="assets/js/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>


	<!-- Imported scripts on this page -->
	<script src="assets/js/jvectormap/jquery-jvectormap-europe-merc-en.js"></script>
	<script src="assets/js/jquery.sparkline.min.js"></script>
	<script src="assets/js/rickshaw/vendor/d3.v3.js"></script>
	<script src="assets/js/rickshaw/rickshaw.min.js"></script>
	<script src="assets/js/raphael-min.js"></script>
	<script src="assets/js/morris.min.js"></script>
	<script src="assets/js/toastr.js"></script>
	<script src="assets/js/neon-chat.js"></script>


	<!-- JavaScripts initializations and stuff -->
	<script src="assets/js/neon-custom.js"></script>


	<!-- Demo Settings -->
	<script src="assets/js/neon-demo.js"></script>

	
</body>
</html>
