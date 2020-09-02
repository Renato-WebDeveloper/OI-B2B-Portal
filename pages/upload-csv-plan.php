<?php 
require "../template/template_full.php";

if($user->permissions('ADMIN')) {

} else {
  ?><script type="text/javascript">window.location.href="403.html";</script><?php
}

?>

<!-- main -->
<div class="right_col" role="main">
	<div class="">
    <div class="row">
      <div class="col-md-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>UPLOAD - CSV REPORT<small></small></h2>

            <span class="horario" id="data-hora"></span>
            <ul class="nav navbar-right panel_toolbox">
              <li>
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li>
                <a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-12">
                  <form enctype="multipart/form-data" action="save-csv-plan.php" method="POST" name="input_file">
                    <strong>Enviar Planta Mensal</strong><br/>
                    <input class="form-control-file" name="userfile" type="file" id="upload_csv_report"/>
                    <input type="submit" value="Enviar arquivo" class="btn btn-primary"/>
                  </form>
                </div>
              </div>
            </div><br/>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- main -->


<?php require "../template/template_footer.php"; ?>



