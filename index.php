<?php
require_once 'class/Conexao.php';
require_once 'class/Login.php';

session_start();

if (isset($_POST['send'])):
    $login = filter_input(INPUT_POST, "email", FILTER_SANITIZE_MAGIC_QUOTES);
    $senha = filter_input(INPUT_POST, "password", FILTER_SANITIZE_MAGIC_QUOTES);

    $l = new Login();
    $l->setLogin($login);
    $l->setSenha($senha);

    if ($l->logar()):
        header("Location: eventos.php");
    else:
        header('Location: index.php?error=1');
    endif;

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

        <link rel="stylesheet" href="assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
        <link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
        <link rel="stylesheet" href="assets/css/bootstrap.css">
        <link rel="stylesheet" href="assets/css/neon-core.css">
        <link rel="stylesheet" href="assets/css/neon-theme.css">
        <link rel="stylesheet" href="assets/css/neon-forms.css">
        <link rel="stylesheet" href="assets/css/skins/black.css">
        <link rel="stylesheet" href="assets/css/custom.css">

        <script src="assets/js/jquery-1.11.0.min.js"></script>

        <script>$.noConflict();</script>


    </head>
    <body class="page-body login-page login-form-fall" onload="document.getElementById('email').focus();">

        <div class="login-form">

            <center><img src="assets/images/2logo.png" width="310" height="180"> </center>

            <div class="login-content">

                <?php
                if (isset($_GET['error'])) {
                    echo '<center><p class="error">Erro ao fazer o login!</p></center>';
                }
                ?>

                <form action="" method="post" role="form" id="login_form">

                    <div class="form-group">

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="entypo-user"></i>
                            </div>

                            <input type="text" class="form-control"  name="email" id="email" placeholder="Email" />
                        </div>

                    </div>

                    <div class="form-group">

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="entypo-key"></i>
                            </div>

                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off" />
                        </div>

                    </div>

                    <div class="form-group">
                        <button type="submit" name="send" class="btn btn-primary btn-block btn-login">
                            <i class="entypo-login"></i>
                            Login In
                        </button>
                        <button type="button" onclick="window.location.href = 'lostpassword.php'" class="btn btn-primary btn-block">
                            <i class="entypo-cross"></i>
                            Esqueci a senha!
                        </button>
                        <button type="button" onclick="window.location.href = 'register.php'" class="btn btn-primary btn-block">
                            <i class="entypo-user"></i>
                            Register
                        </button>
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
    <script src="assets/js/neon-login.js"></script>
    <script src="assets/js/neon-custom.js"></script>
    <script src="assets/js/neon-demo.js"></script>

</body>
</html>
