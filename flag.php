<?php
session_start();
require_once 'class/Conexao.php';
require_once 'class/flags_class.php';
$user_id = htmlentities($_SESSION['user_id']);
$idteam = htmlentities($_SESSION['idteam']);
$evento = new flags_class();
if (isset($_GET['evento'])):
    $evento->setEvento($_GET['evento']);
else:
    $evento->setEvento(0);
endif;
$evento->insereScore($user_id, $idteam);
$evento->scoreTeam($idteam);
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php
        //valida flag
        if (isset($_POST['flag'], $_POST['order'])) {
            $flagid = filter_input(INPUT_POST, "order", FILTER_SANITIZE_MAGIC_QUOTES);
            $resposta = filter_input(INPUT_POST, "flag", FILTER_SANITIZE_MAGIC_QUOTES);
            $evento->setFlagid($flagid);
            $evento->setResposta($resposta);
            if ($evento->validaFlag($user_id, $idteam) == true) {
                
            } else {
                echo '<script>alert("Flag inválida!")</script>';
            }
        }
        ?>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="" />
        <meta name="author" content="" />

        <title>CTF-H4K</title>

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
                                    <span class="title">Flags</span>
                                </a>
                            </li>
                            <li>
                                <a href="eventos.php">
                                    <i class="entypo-layout"></i>
                                    <span class="title">Eventos</span>
                                </a>
                            </li>
                            <li>
                                <a href="profile.php">
                                    <i class="entypo-user"></i>
                                    <span class="title">Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo "score.php?evento=" . $evento->getEvento(); ?>">
                                    <i class="entypo-layout"></i>
                                    <span class="title">Scoreboard</span>
                                </a>
                            </li>
                        </ul>


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

                    <div class="container">
                        <div class="row">
                            <br><br>
                            <div class="col-md-12">
                                <center><img src="assets/images/1logo.png"></center>			
                                <h4>Fl4g5</h4>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th><center>Total</center></th>
                                    <?php
                                    $evento->listaTipoFlags();
                                    ?>
                                    </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td><strong><?php echo $_SESSION['username'] ?></strong></td>
                                            <td><center><button type="button" class="btn btn-blue"><?php echo $evento->GetScore($user_id); ?></button>
                                    </center></td>

                                    <?php $evento->carregaBotoes($user_id); ?>

                                    </tr>
                                    </tbody>
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
        <!-- carrega flags -->
        <?php $evento->carregaChall(); ?>
    <?php else : ?>
        <p>
            <span class="error">Você não tem autorização para acessar esta página.</span> <a href=" index.php">login</a>.
        </p>
    <?php endif; ?>

</body>
</html>
