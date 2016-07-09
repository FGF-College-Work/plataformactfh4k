<?php
session_start();
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
        <script src="assets/js/flipclock.js"></script>	
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
        <?php if (isset($_SESSION['username'])) : ?>
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
                               		
                                <h4>Eventos</h4>
		<br />
		
		<table class="table table-bordered datatable" id="table-1">
			<thead>
				<tr>
					<th>Evento</th>
					<th>Data Inicio</th>
					<th>Formato Flag</th>
                                        <th><center>Acesso</center></th>
					<th><center>Ranking</center></th>
                                        <th><center>Ranking Team</center></th>
				</tr>
			</thead>
			<tbody>
                            <?php
                                require_once 'class/Conexao.php';
                                require_once 'class/Evento.php';
                                
                                $evento = new Evento();
                                $evento->listar();
                            ?>

			</tbody>
			
		</table>
		
		<script type="text/javascript">
		var responsiveHelper;
		var breakpointDefinition = {
		    tablet: 1024,
		    phone : 480
		};
		var tableContainer;
		
			jQuery(document).ready(function($)
			{
                                tableContainer = $("#table-1");
				
                              	tableContainer.dataTable({
					"order": [[ 1, "desc" ]],
                                        "sPaginationType": "bootstrap",
					"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
					"bStateSave": false,
					
		
				    // Responsive Settings
				    bAutoWidth     : false,
				    fnPreDrawCallback: function () {
				        // Initialize the responsive datatables helper once.
				        if (!responsiveHelper) {
				            responsiveHelper = new ResponsiveDatatablesHelper(tableContainer, breakpointDefinition);
				        }
				    },
				    fnRowCallback  : function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
				        responsiveHelper.createExpandIcon(nRow);
				    },
				    fnDrawCallback : function (oSettings) {
				        responsiveHelper.respond();
				    }
				});
				
				$(".dataTables_wrapper select").select2({
					minimumResultsForSearch: -1
				});
                              
			});
		</script>

                            </div>
                        </div>

                        

                        <!-- Footer -->
                        <footer class="main">

                            CTF-H4k &copy; 2016 <strong>CTF-H4k</strong>

                        </footer>

                    </div>
                </div>
            </div>
        </div>

    <?php else : ?>
        <p>
            <span class="error">Você não tem autorização para acessar esta página.</span> <a href="index.php">login</a>.
        </p>
    <?php endif; ?>



        <script src="assets/js/gsap/main-gsap.js"></script>
        <script src="assets/js/joinable.js"></script>
        <script src="assets/js/resizeable.js"></script>
        <script src="assets/js/neon-custom.js"></script>
        <script src="assets/js/jquery.dataTables.min.js"></script>
        <script src="assets/js/datatables/TableTools.min.js"></script>
        <script src="assets/js/dataTables.bootstrap.js"></script>
        <script src="assets/js/datatables/jquery.dataTables.columnFilter.js"></script>
        <script src="assets/js/datatables/lodash.min.js"></script>
        <script src="assets/js/datatables/responsive/js/datatables.responsive.js"></script>
        
        <script src="assets/js/toastr.js"></script>


</body>
</html>
