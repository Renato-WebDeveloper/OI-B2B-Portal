<?php session_start();

if(empty($_SESSION['id']) && !isset($_SESSION['id'])) {
  header("location: login.php");
  exit;
}

?>


<!DOCTYPE html>
<html lang="en">
  <head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Portal de Indicadores B2B - GRJ</title>
    <!-- Bootstrap -->
    <link href="../frontend_vendor/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../frontend_vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../frontend_vendor/nprogress/nprogress.css" rel="stylesheet">
    <!--CSS manual-->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">


  </head>

  <?php 
  require "../vendor/autoload.php";
  require "../connect_db/config.php";

  
  use \src\Classes\User\User as User;
  $user = new User($pdo);
  $user->setUser($_SESSION['id']);
  ?>
  
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed"> <!--Menu fixed -->
          <div class="left_col scroll-view">
            <div class="navbar nav_title">
              <a href="index.php" class="site_title">
                <img class="logo_left" src="../assets/images/logo_oi.png">
                <span class="logo_left_title">
                  Indicadores B2B
                </span>
              </a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->

            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="../assets/images/user2.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Bem vindo,</span>
                <h2><?php echo $user->getUsername() ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->

            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Menu</h3>
                <ul class="nav side-menu">
                  <?php if ($user->permissions('ADMIN')): ?>
                  <li><a><i class="fa fa-code"></i> Admin <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="user-control.php">Controle de usuários</a></li>
                      <li><a href="upload-csv-report.php">Upload CSV-MYSQL - Report</a></li>
                      <li><a href="upload-csv-plan.php">Upload CSV-MYSQL - Planta</a></li>
                      <li><a href="upload-csv-meta.php">Upload CSV-MYSQL - Meta</a></li>
                    </ul>
                  </li>
                  <?php endif; ?>
                  <?php if ($user->permissions('TESTER')): ?>
                  <li><a><i class="fa fa-cloud-download"></i> Downloads <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="base-download.php?bdCorr=1">Base de reparos R1</a></li>
                      <li><a href="base-download.php?bdR2=1">Base de reparos R2</a></li>
                    </ul>
                  </li>
                  <?php endif; ?>
                  
                  
                </ul>
              </div>
            </div>
            
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="logout.php">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <div class="nav toggle">
                  <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <nav class="nav navbar-nav">
                <ul class=" navbar-right">
                  <span class="title_head"> Portal de Indicadores B2B - GRJ</span><!--Renato  // logomarca e title-->

                  <form class="form-group row pull-right top_search">
                    <div class="input-group">
                      <input type="text" class="form-control search" placeholder="Pesquisar...">
                      <span class="input-group-btn">
                          <button class="btn btn-secondary search" type="submit"><i class="fa fa-search"></i></button>
                      </span>
                    </div>
                  </form> 

                </ul>
              </nav>
            </div>
          </div>
          <br/>
        <!-- /top navigation -->


