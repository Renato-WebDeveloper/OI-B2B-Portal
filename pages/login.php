<?php session_start();
require "../vendor/autoload.php";
require "../connect_db/config.php";

use src\Classes\User\User as User;

$user = new User($pdo);
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login Portal de indicadores B2B | </title>
    <!-- Bootstrap -->
    <link href="../frontend_vendor/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../frontend_vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../frontend_vendor/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../frontend_vendor/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            
            <?php
            if (isset($_POST['username']) && !empty($_POST['password'])) {
              $username = addslashes($_POST['username']);
              $password = addslashes($_POST['password']);

              if($user_data = $user->loginUser($username, md5($password))) {
                if ($user_data['status_'] == 0) {
                  ?>
                  <div class="alert alert-warning">
                      <strong>OPS!</strong> - Usuário aguardando ativação...
                  </div> 
                  <?php
                } else {
                  $_SESSION['id'] = $user_data['id'];
                  header("location: index.php");
                }
              } else {
                ?>
                <div class="alert alert-danger">
                    <strong>OPS!</strong> - Usuário e ou senha inválidos
                </div> 
                <?php
              }
            }
            ?>
            
            <form method="POST">
              <h1>Login Portal B2B</h1>
              <div>
                <input type="text" class="form-control" placeholder="Usuário" required="" name="username"/>
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Senha" required="" name="password"/>
              </div>
              <div>
                <input type="submit" class="btn btn-primary submit" value="Entrar"/>
                <a type="button" class="reset_pass" data-toggle="modal" data-target="#ExemploModalCentralizado">
                   Perdeu sua senha?
                </a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Novo no portal?
                  <a href="register.php" class="to_register"> Crie sua conta </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><img src="../assets/images/logo_oi.png" width="36px;" height="36px;"> Portal de indicadores B2B</h1>
                  <p>©2020 Todos os direitos reservados. Portal de indicadores.</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
      <!-- Modal -->
      <div class="modal fade" id="ExemploModalCentralizado" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="TituloModalCentralizado">Recuperação de senha</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Em caso de perda de senha entre em contato com nosso suporte imediatamente.</br></br>
              <strong>Email: suporte.portalb2b@gmail.com</strong>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
            </div>
          </div>
        </div>
      </div>
    <script src="../frontend_vendor/jquery/dist/jquery.min.js"></script>
    <script src="../frontend_vendor/bootstrap/dist/js/bootstrap.min.js"></script>
  </body>
</html>


